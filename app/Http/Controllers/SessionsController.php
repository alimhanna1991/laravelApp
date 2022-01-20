<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('/')->with('success','GoodBye!');
    }
    public function create(){
       return view('sessions.create');
    }
    public function store(){
        // Validate Input
        $att = request()->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
         // auth fail
        // First way
        if( ! auth()->attempt($att)){
            back()
            ->withInput()
            ->withErrors(['email'=>'Your provided credentials could not be verified']);
        }

        //Second Way

    //    return throw ValidationException::withMessages([
    //         'email'=>'Your provided credentials could not be verified'
    //     ]);


            session()->regenerate();
            // redirect with success message
            return redirect('/')->with('success','Welcome Back');



    }

}
