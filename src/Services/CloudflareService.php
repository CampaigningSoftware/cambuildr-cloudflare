<?php

namespace CampaigningSoftware\CambuildrCloudflare\Services;

use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIToken;
use Cloudflare\API\Endpoints\DNS;

class CloudflareService
{
    private DNS $dns;

    public function __construct()
    {
        $token = new APIToken(config('cambuildr-cloudflare.api_token'));
        $adapter = new Guzzle($token);
        $this->dns = new DNS($adapter);
    }

    /**
     * check if a CNAME or A entry for the existing DNS record name already exists
     *
     * @param string $name
     *
     * @return bool
     */
    public function checkExistenceOfDnsEntry(string $name): bool
    {
        $cnameRecords = $this->dns->listRecords(config('cambuildr-cloudflare.zone_id'), 'CNAME', $name, '', 1, 1);

        if ($cnameRecords->result_info->total_count > 0) {
            return true;
        }

        $aRecords = $this->dns->listRecords(config('cambuildr-cloudflare.zone_id'), 'A', $name, '', 1, 1);

        return $aRecords->result_info->total_count > 0;
    }

    /**
     * create a cname entry for the content defined in the config.
     *
     * @param string $subdomain
     *
     * @return bool
     */
    public function createSubdomain(string $subdomain): bool
    {
        return $this->dns->addRecord(config('cambuildr-cloudflare.zone_id'), 'CNAME', $subdomain,
            config('cambuildr-cloudflare.cname_record_content'), 120, false);
    }

    /**
     * delete a cname entry from cloudflare
     *
     * @param string $subdomain
     *
     * @return bool
     */
    public function deleteSubdomain(string $subdomain): bool
    {
        $existingRecords = $this->dns->listRecords(config('cambuildr-cloudflare.zone_id'), 'CNAME',
            $subdomain . '.' . config('cambuildr-cloudflare.domain'));

        if ($existingRecords->result_info->total_count === 0) {
            return true;
        }

        return $this->dns->deleteRecord(config('cambuildr-cloudflare.zone_id'), $existingRecords->result['0']->id);
    }
}