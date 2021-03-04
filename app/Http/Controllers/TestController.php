<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    
    public function test(){
        $user = User::findOrFail(6);
        return view('test.index', compact('user'));
    }

}
