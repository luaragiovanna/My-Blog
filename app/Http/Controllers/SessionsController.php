<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function create(){
        return view('sessions.create');
    }


    public function store(){
        $attributes = request()->validate([
            'email'=> 'required|exists:users,email', //precisa achar usuario q existe cm email especifico 
            'password' =>'required'
        ]);

        if(auth()->attempt($attributes)){
            //confirma se inseriu correto password
            //session fixation
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome Back!');
        }

        return back()->withErrors(['email'=> 'Your provides credentials could not be verifed :(']); ///$errors
    }
    public function destroy(){
       //dd('hi');
       auth()->logout();
       return redirect('/')->with('success', 'Goodbye');
    }
}
