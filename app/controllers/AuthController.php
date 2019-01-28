<?php

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\classes\Request;
use Dotenv\Validator;
use App\Classes\ValidateRequest;
use App\Models\User;

class AuthController extends BaseController
{

public function showRegisterForm()
    {
        return view('register');
    }
public function showLoginForm()
    {
        return view('login');
    }
    public function register()
    {
       if(Request::has('post')){
           $request = Request::get('post');
           if (CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [
                    'username' => ['required' =>true, 'maxlength' => 20,'string' => true, 'unique' => 'users'],
                    'email' => ['required' =>true, 'email' => true, 'unique' => 'users'],
                    'password' => ['required' =>true, 'minLength' => 6],
                    'fullname' => ['required' =>true, 'minLength' => 6, 'maxlength' => 50],
                    'address' => ['required' =>true, 'minLength' => 4, 'maxlength' => 500, 'mixed' =>true]
                ];
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    return view('register', compact('errors'));
                }
                User::create([
                    'username'=> $request->username,
                    'email'=> $request->email,
                    'fullname'=> $request->fullname,
                    'address'=> $request->address,
                    'role'=> 'user',
                    'password'=> password_hash($request->password, PASSWORD_BCRYPT)
                ]);
                Request::refresh();
                return view('register',['success'=> 'User Created please login']);
           }
           throw new \Exception('Token Missmatch');
       }
       return null;
    }
    public function login()
    {
       
    }
}