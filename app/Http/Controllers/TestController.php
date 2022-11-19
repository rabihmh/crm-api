<?php

namespace App\Http\Controllers;

use Crm\User\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return User::orderByDesc('id')->get(['name', 'id'])->take(2);
//        $user = new User();
//        $user->name = 'jad';
//        $user->password = Hash::make('password');
//        $user->email = 'jad@mail.com';
//        $user->save();
    }
}
