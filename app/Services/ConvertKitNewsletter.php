<?php
namespace App\Services;
class ConvertKitNewsletter implements iNewsletter
{
    
    public function subscribes(string $email, ?string $list = null)
    {
        //subscribe the user with convertKit-specific api request
    }
    
}