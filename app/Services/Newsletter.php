<?php
namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter implements iNewsletter{

    

    public function __construct(protected ApiClient $client)
    {

    }
    
        
    
    public function subscribes(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
        //null safe operator?
        //$mailchimp = new \MailchimpMarketing\ApiClient();
    
		/*$mailchimp->setConfig([
			'apiKey' =>config('services.mailchimp.key'),
			'server' => 'us17'
		]);*/

        return $this->client->lists->addListMember(config('services.mailchimp.lists.subscribers'),[
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
}


}