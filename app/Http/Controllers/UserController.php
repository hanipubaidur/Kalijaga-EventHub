<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:255',
            'email' => 'required|unique:users',
            'password'=> 'required|max:255',
            'role_id' => 'required|'.Rule::in(['1','2']),
        ]);

        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return response(['data' => $user]);
    }
}
