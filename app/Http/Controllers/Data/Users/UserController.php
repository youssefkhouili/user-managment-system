<?php

namespace App\Http\Controllers\Data\Users;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(['results' => User::latest()->paginate(20)]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'role') + ['password' => bcrypt($request->password)]);
        return response()->json(["user" => $user]);
    }

    public function destroy(User $user)
    {
        return "successfully deleted {$user->name}";
    }
}