<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::get();
        return response()->json(['users' => $users, 'message' => 'User fetched successfully']);
    }
}
