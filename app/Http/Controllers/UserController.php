<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response(User::all(), 200);
    }

    public function store()
    {
        $user = User::create(request()->all());

        return response([
            'user_id' => $user->id
        ], 200);
    }
}
