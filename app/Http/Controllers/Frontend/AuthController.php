<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class AuthController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * show Registration Form
     *
     * @param Request $request
     * @return void
     */
    public function showRegistrationForm(Request $request)
    {

    }

    /**
     * register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        # code...
    }

    /**
     * register
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        return view('Frontend.Auth.login');
    }

    /**
     * register
     *
     * @param Request $request
     * @return void
     */
    public function postLogin(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];

        $messages = [
            'username.required' => __('The courriel ou pseudo field is required.'),
            'password.required' => __('The password field is required.'),
            'password.min'      => __('The password must be at least 6 characters.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }
        
        $userAndPass = array(
            'username'  => $request->get('username'),
            'password' => $request->get('password')
        );
        
        $emailAndPass = array(
            'email'  => $request->get('username'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($userAndPass) || Auth::attempt($emailAndPass)) {
            return redirect("/home");
        } else {
            return back()->with('error', __('Username or password is incorrect.'));
        }
    }   

    /**
     * register
     *
     * @param Request $request
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }

}
