# CamBuildr Cloudflare

Provides a simple way to interact with the Cloudflare API (check existence of DNS entries; create subdomains; delete
subdomains)

## Installation

Installation is possible via composer

```bash
composer require campaigningsoftware/cambuildr-cloudflare
```

The package will automatically register itself.

## Config

The config file can be published via:

```bash
php artisan vendor:publish --provider="CampaigningSoftware\CambuildrCloudflare\CambuildrCloudflareServiceProvider" --tag="config"
```
The following `.env` entries are used, if the config is not changed:
- `CLOUDFLARE_API_TOKEN` 
- `CLOUDFLARE_ZONE_ID` 
- `CLOUDFLARE_CNAME_RECORD_CONTENT` 
- `CLOUDFLARE_DOMAIN`

## Testing

```bash
composer test
```