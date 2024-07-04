<?php

return [
    'api_token'            => env('CLOUDFLARE_API_TOKEN', ''),
    'zone_id'              => env('CLOUDFLARE_ZONE_ID', ''),    // cambuildr zone id
    'cname_record_content' => env('CLOUDFLARE_CNAME_RECORD_CONTENT', ''),
    'domain'               => env('CLOUDFLARE_DOMAIN', ''),
];