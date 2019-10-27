<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    //       $user                  = Auth::user();
    //       $username = $user->name;
    //       return response()->json([
    //         'status'   => 'success',
    //         'user' => $username,
    //       ]);
    //     } else {
    //       return response()->json([
    //         'status' => 'error',
    //         'user'   => 'Unauthorized Access'
    //       ]);
    //     }
    // }


    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where($this->username(), $request->input('email'))->first();

        if ($user && !$user->activated) {
            $errorMessage = 'You need to activate your account first'; // you can use trans here too
        }
        else {
            $errorMessage = trans('auth.failed');
        }

        $errors = [$this->username() => $errorMessage];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

}
