<?php

//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Password;
//
//
//class ResetPasswordController extends Controller{
//    protected $redirectPath = '/admin/password/reset';
//    protected function guard(){
//        return Auth::guard('admin');
//    }
//
//    public function showResetForm()
//    {
//        return view('auth.passwords.reset');
//    }
//
//
//
//    public function reset(Request $request)
//    {
//        $this->validate($request, [
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|confirmed|min:8',
//        ]);
//
//        $response = $this->broker()->reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
//            $this->resetPassword($user, $password);
//        }
//        );
//
//        if ($response == Password::PASSWORD_RESET) {
//            return redirect()->route('admin.login')->with('status', trans($response));
//        }
//
//        return back()->withErrors(
//            ['email' => trans($response)]
//        );
//    }
//
//    public function __construct()
//    {
//        $this->middleware('guest:admin');
//    }
//
//    protected function broker()
//    {
//        return Password::broker('admins');
//    }
//
//    protected function resetNotifier()
//    {
//        return PasswordResetNotification::class;
//    }
//}
//


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    public function create()
    {
        return view('auth.passwords.email');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // guard();
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        // if (Auth::guard('admin')->attempt($validatedData)) {
        // Redirect to the intended page
        // return redirect()->intended('/dashboard');


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        // }
    }

    public function __construct()
    {
        $this->middleware('guest:admin');
    }
}
