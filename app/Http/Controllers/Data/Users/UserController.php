<?php

namespace App\Http\Controllers\Data\Users;

use App\Events\Users\CreatedUser;
use App\Events\Users\DeletingUser;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                return response('Unauthorized', 403);
            }

            return $next($request);
        })->only('destroy', 'index');
    }

    public function index()
    {
        return response()->json(['results' => User::latest()->paginate(20)]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'role') + ['password' => bcrypt($request->password)]);
        event(new CreatedUser($user));
        return response()->json(["user" => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        event(new DeletingUser($user));

        return response()->json(["msg" => "Successfully deleted $user->name"]);

        // return "successfully deleted {$user->name}";
    }
}
