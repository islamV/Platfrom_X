<?php

namespace App\Http\Controllers;


use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;


class InstructorAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:instructor')->except('logout');
    }

    public function login(Request $request)
    {
        return view('instructor.login');
    }

    public function loginPost(Request $request)  {
        // dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:225|min:8'
        ]);
        if(!$request->expectsJson()){
            if(Auth::guard('instructor')->attempt($request->only('email', 'password'))) {
               
                return redirect('instructor/dashboard');
            } else {
                return back()->with('error', 'Email or Password is incorrect');
            }
        }else{
            if (Auth::guard('instructor')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                $user = Instructor::where('email', $request->email)->first();
                return $user->createToken($user->name)->plainTextToken;
            } else {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
        }
        return redirect('instructor/dashboard');

    }

    public function logout(Request $request)
    {
        if($request->expectsJson()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($request->bearerToken());
            if($accessToken != null)
                $accessToken->delete();
            Auth::guard('instructor')->logout();
            return response()->json(['message' => 'Logged out']);
        }else{
            if(!Auth::guard('instructor')->check()){
                return route('instructor_login');
            }
            Auth::guard('instructor')->logout();
            return redirect()->route('instructor_login');
        }
    }

    public function register()
    {
        return view('instructor.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email|unique:instructors,email',
            'password' => 'required|min:6',
         
        ]);
       
        $user = Instructor::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
 
        ]);
    
        return redirect('instructor/dashboard');
    }
}
