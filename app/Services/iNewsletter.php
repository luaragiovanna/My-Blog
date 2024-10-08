<?php 

namespace App\Services;

interface iNewsletter{

    public function subscribes(string $email, string $list = null);
    
}