<?php

namespace App\Http\Controllers;

use App\Models\User_table;
use Illuminate\Http\Request;
use Session;
class AuthController extends Controller
{
    public function Dashboard(){
        return view('admin.pages.dashboard'); 
    }
    public function signup(){
        return view('admin.pages.signup');
    }
    public function createUser(Request $req){
        $name = $req->name;
        $email = $req->email;
        $password = $req->password;
        $confirm = $req->cnf_password;
        // $role = $req->role;
        if($password == $confirm){
            $user_exists = User_table::where('email','=',$email)->first();
            if($user_exists){
                return redirect()->back()->with('info', 'Account Already Exists.');
            }
            else{
                $obj = new User_table();
                $obj->name=$name;
                $obj->email=$email;
                $obj->password=md5($password);
                // $obj->role=$role;
                if($obj->save()){
                    return redirect()->back()->with('info', 'Account Created. Waiting for approval.');
                }
                else{
                    $errors = $obj->getErrors();
                }
                try {
                    $obj = new User_table();
                    $obj->name = $name;
                    $obj->email = $email;
                    $obj->password = md5($password);
                    $obj->save();
                    // Data saved successfully
                } catch (\Exception $e) {
                    // Data save failed
                    $error_message = $e->getMessage();
                    // You can log or display the error message using the appropriate method
                }
                
            }
        }
        else{
            return redirect()->back()->with('info', 'Password Mismatch');
        }
    }
    public function signin(){
        return view('admin.pages.signin');
    }
    public function usersignin(Request $req){
        $email = $req->email;
        $password = $req->password;
        // SELECT * from users WHERE email='anik@gmail.com' AND password='';
        $user = User_table::where('email','=',$email)
             ->where('password','=',md5($password))
             ->first();
        if($user){
            if($user->is_approved==1){
                Session::put('username',$user->name);
                return redirect('admin/dashboard');
            }
            else{
                return redirect()->back()->with('info', 'Not Approved yet.');
            }
            
        }
        else{
            return redirect()->back()->with('info', 'Invalid email or password');
        }
    }
}