<?php

namespace App\Http\Controllers;

use App\Models\User_table;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Dashboard(){
        return view('admin.pages.dashboard'); 
    }
    public function login(){
    
        return view('admin.pages.login');
    }
    public function registration(){
        return view('admin.pages.registration');
    }
    public function signup(){
        return view('admin.pages.signup');
    
    }
    public function signin(){
        return view('admin.pages.signin');
    }
    public function createUser(Request $req){
        $name = $req->name;
        $email = $req->email;
        $password = $req->password;
       // $confirm = $req->cnf_password;
        $role = $req->role;
        $user_exists = User_table::where('email','=',$email)->first();
            if($user_exists){
                return redirect()->back()->with('info', 'Account Already Exists.');
            }
            else{
                $obj = new User_table();
                $obj->name=$name;
                $obj->email=$email;
                $obj->password=md5($password);
                $obj->role=$role;
                if($obj->save()){
                    return redirect()->back()->with('info', 'Account Created. Waiting for approval.');
                }
            }
    }
}