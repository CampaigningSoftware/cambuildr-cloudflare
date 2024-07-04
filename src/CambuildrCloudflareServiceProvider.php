<?php
namespace CampaigningSoftware\CambuildrCloudflare;

use Illuminate\Support\ServiceProvider;

class CambuildrCloudflareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/cambuildr-cloudflare.php' => config_path('cambuildr-cloudflare.php'),
            ], 'config');

        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cambuildr-cloudflare.php', 'cambuildr-cloudflare');
    }
}