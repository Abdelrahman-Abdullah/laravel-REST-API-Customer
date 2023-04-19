<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/setup'  , function (){
//    $cred = [
//        'email' => 'admin@api.com',
//        'password' => 'admin',
//    ];
//
//    if (! Auth::attempt($cred))
//    {
//        $user = new \App\Models\User();
//
//        $user->name     = 'Admin';
//        $user->email    = $cred['email'];
//        $user->password = Hash::make($cred['password']);
//
//        $user->save();
//
//        if (Auth::attempt($cred))
//        {
//            $user = Auth::user();
//
//            return [
//                'admin' => $user->createToken('admin-token' , ['*'])->palinTextToken,
//                'user' => $user->createToken('user-token' , ['create' , 'update'])->palinTextToken
//            ];
//        }
//    }
//});
