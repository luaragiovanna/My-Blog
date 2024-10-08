<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        
        return view('register.create');
    }

    public function store(){
        //var_dump(request()->all());
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required| max:255 |min:3|unique:users,username',
            'email' => 'required|email|max:255 |unique:users,email',
            'password' => 'required|min:7|max:255',
        ]);
        //$attributes['password'] = bcrypt($attributes['password']); //Automatic Password Hashing With Mutators
        $user = User::create($attributes); 


        //logar user dentro do blog
        auth()->login($user);
        return redirect('/')->with('success', 'Your account has been created.');
        //return redirect('/');
    }

    

}
