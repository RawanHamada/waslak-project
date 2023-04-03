<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest:admin')->except('logout');

    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

//        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
//            return redirect()->intended('/dashboard');
//        }
//
//        return back()->withInput($request->only('email', 'remember'));

        // Attempt login with the validated credentials
        if (Auth::guard('admin')->attempt($validatedData)) {
            // Redirect to the intended page
            return redirect()->intended('/');
        } else {
            // Redirect back with errors
            return redirect()->back()->withErrors(['Invalid email or password']);

//            return redirect()->back()->withErrors([
//                'email' => 'Invalid email address',
//                'password' => 'Invalid password'
//            ]);
        }
    }

    public function logout()
{
    Auth::guard('admin')->logout();

    return redirect()->route('admin.login');
}
}
