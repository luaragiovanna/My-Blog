<?php

namespace App\Http\Controllers;

use App\Services\iNewsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class  NewsletterController extends Controller
{
    public function __invoke(iNewsletter $newsletter)
    {
        //dd($newsletter);
        request()->validate(['email' => 'required|email']);

        try{
            $newsletter->subscribes(request('email'));

        }catch(\MailchimpMarketing\ApiException $e){
            //dd($e);
            throw ValidationException::withMessages([
                'email' => 'This email é invalido', $e->getMessage()
            ]);
        }
        return redirect('/') ->with('success', 'Deu boa');
    }
}
