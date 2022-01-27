<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('newsletter',function(){
    request()->validate([
        'email'=>'required|email'
    ]);
    $mailchimp = new \MailchimpMarketing\ApiClient();

$mailchimp->setConfig([
	'apiKey' => config('services.mailchimp.key'),
	'server' => 'us14'
]);
try{
    $response = $mailchimp->lists->addListMember('d79e35e326',[
        'email_address'=>request('email'),
        'status'=>'subscribed'
    ]);
}
catch(\Exception $e){
throw \Illuminate\Validation\ValidationException::withMessages([
    'email'=>' This Email Cannot be added'
]);
}

return redirect('/')->with('success','You Are new Signed up for news letter');
});

Route::get('/',[PostController::class, 'index'])->name("home");

Route::get('posts/{post:slug}',[PostController::class , 'show']);
Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);
Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register', [RegisterController::class,'store'])->middleware('guest');
Route::post('logout', [SessionsController::class,'destroy'])->middleware('auth');
Route::get('login', [SessionsController::class,'create'])->middleware('guest');
Route::post('login', [SessionsController::class,'store'])->middleware('guest');

Route::get('admin/posts/create',[
PostController::class,'create'
])->middleware('admin');
