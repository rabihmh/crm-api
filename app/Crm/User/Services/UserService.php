<?php

namespace Crm\User\Services;

use App\Crm\User\Request\UserRequest;
use Crm\User\Events\UserCreation;
use Crm\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function index()
    {
        return 1;
    }

    public function create(UserRequest $request): ?User
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        event(new UserCreation($user));
        return $user;
    }
}
