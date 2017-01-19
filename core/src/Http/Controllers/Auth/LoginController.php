<?php

namespace Leafr\Core\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use Leafr\Core\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backoffice/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('leafr.core::auth.login');
    }

    /**
     * Process the login form
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if ($auth = Sentinel::authenticate($request->all())) {
            return redirect()->intended();
        }

        return redirect()->back()
            ->withInput()
            ->withErrors('Invalid login or password.');
    }

    /**
     * Log the user out
     *
     * @return mixed
     */
    public function logout()
    {
        if(Sentinel::logout()) {
            return redirect()->route('core.login');
        }
    }
}
