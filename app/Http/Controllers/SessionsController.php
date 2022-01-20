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
        if(auth()->attempt($att)){
            session()->regenerate();
            // redirect with success message
            return redirect('/')->with('success','Welcome Back');
        }
        // auth fail
        // First way
        return back()
                 ->withInput()
                 ->withErrors(['email'=>'Your provided credentials could not be verified']);

        //Second Way

    //    return throw ValidationException::withMessages([
    //         'email'=>'Your provided credentials could not be verified'
    //     ]);

    }

}
