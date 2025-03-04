<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\URL;

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

    /**
     * Show the application's login form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        // Store the current URL as the intended URL when accessing the login page
        if (!session()->has('url.intended')) {
            session(['url.intended' => URL::previous()]);
        }

        return view('auth.login');
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        // First check for the URL intended by the user
        if (session()->has('url.intended')) {
            return session()->pull('url.intended', $this->redirectTo);
        }

        // Otherwise return the default redirect path
        return $this->redirectTo;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Check for disabled users (role = 2)
        if ($user->role === 2) {
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', 'Your account has been disabled. Please contact the administrator.');
        }

        return redirect()->intended($this->redirectPath());
    }
}
