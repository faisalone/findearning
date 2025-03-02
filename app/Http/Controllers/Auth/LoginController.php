<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override the username method to use 'login' as the field instead of email.
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        // Try to authenticate by email
        if ($this->guard()->attempt(['email' => $login, 'password' => $password], $request->filled('remember'))) {
            return true;
        }

        // Try to authenticate by contact
        if ($this->guard()->attempt(['contact' => $login, 'password' => $password], $request->filled('remember'))) {
            return true;
        }

        return false;
    }

    /**
     * Override sendFailedLoginResponse to assign error to password field if email exists.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $login = $request->input('login');
        $user = User::where('email', $login)->orWhere('contact', $login)->first();
        
        $errors = $user
            ? ['password' => trans('auth.password')]
            : ['login' => trans('auth.failed')];

        throw ValidationException::withMessages($errors);
    }
}
