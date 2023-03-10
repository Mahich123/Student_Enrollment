<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Dashboard(){
        return view('admin.layouts.template'); 
    }
}
