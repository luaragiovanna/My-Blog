<?php

namespace App\Providers;

use App\Services\iNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(iNewsletter::class, function(){
            $client = new ApiClient();
            
            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us17'
            ]);
            return new Newsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();//desativa o fillabe(quais campos podem ser alterados ou n)
    }
}
