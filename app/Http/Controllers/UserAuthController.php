<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:instructor')->except('logout');
    }

    public function login()
    {
        return view('user.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if(!$request->expectsJson()){
            if(Auth::attempt($request->only('email', 'password'))) {
             
                return redirect('student/dashboard');
            } else {
                return back()->with('error', 'Email or Password is incorrect');
            }
        }else{
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                $user = User::where('email', $request->email)->first();
               
                return $user->createToken($user->name)->plainTextToken;
            } else {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        if($request->expectsJson()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($request->bearerToken());
            $accessToken->delete();
            Auth::logout();
            return response()->json(['message' => 'Logged out']);
        }else{
            if(!Auth::check()){
                return route('student_login');
            }
            Auth::logout();
            return redirect()->route('student_login');
        }
    }
    public function register()
    {
        return view('user.register');
    }
    public function registerPost(Request $request) 
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email|unique:instructors,email',
            'password' => 'required|min:6',
     
        ]);
       
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
      
        ]);
        return redirect('student/dashboard');
    }

    }

  

