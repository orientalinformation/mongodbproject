<?php 
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Mail;


class AuthController extends Controller
{ 
    /**
     * @var UserRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $userRepository;

    /**
     * BookController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {   
        // check login
        $user = Auth::user();

        if ($user) {
            return redirect()->intended('/admin/dashboard');
        }

        return view('Backend.Auth.signin');
    }

    /**
     * Operation login
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];

        $messages = [
            'username.required' => __('The username field is required.'),
            'password.required' => __('The password field is required.'),
            'password.min'      => __('The password must be at least 6 characters.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        $userData = array(
            'username'  => $request->get('username'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($userData)) {
            return redirect()->intended('/admin/dashboard');
        } else {
            return back()->with('error', __('Username or password is incorrect.'));
        }

    }    

    /**
     * 
     */
    public function showForgotForm()
    {
        return view('Backend.Auth.forgot-password');
    }

    /**
     * 
     */
    public function sendMail(Request $request)
    {
        $rules = [
            'email' => 'required|email|string',
        ];

        $messages = [
            'email.required' => __('The email field is required.'),
            'email.email' => __('Please enter your email.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        // get data
        $email = $request->get('email');
        $user = $this->userRepository->getUserByKey('email', $email);

        if (!$user) {
            return back()->with('error', __("We can't find a user with that e-mail address."));
        }

        // create token and get url 
        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);
        $url = url('admin/password/reset', $token);

        Mail::send('Backend.Auth.emails.send', [
                'title' => "Hi", 
                'content' => "You are receiving this email because we received a password reset request for your account.",
                'contentEnd' => "If you did not request a password reset, no further action is required.",
                'url' => $url
            ], function ($message) use ($email)  {
            $message->from('laravel5.7.co.vn@gmail.com', 'Administrator');
            $message->to($email);
            $message->subject('Reset Password');
        });

        return back()->with('status', __('We have emailed your password reset link.'));      
    }

    /**
     * 
     */
    public function showResetForm($token = null)
    {
        return view('Backend.Auth.form-reset-password')->with(['token' => $token]);
    }

    /**
     * 
     */
    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|string',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];

        $messages = [
            'email.required' => __('The email field is required.'),
            'email.email' => __('Please enter your email.'),
            'password.required' => __('The password field is required.'),
            'password_confirmation.required' => __('The confirm password field is required.'),
            'password_confirmation.min' => __('The password must be at least 6 characters.'),
            'password.confirmed' => __('Password and confirm password not matched.')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        // get data
        $token = $request->get('token');
        $email = $request->get('email');
        $password = $request->get('password');

        // check user by email
        $user = $this->userRepository->getUserByKey('email', $email);

        if (!$user) {
            return back()->with('error', __("We can't find a user with that e-mail address."));
        }

        // check token
        $result = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->tokenExists($user, $token);

        if (!$result) {
            return back()->with('error', __('This password reset token is invalid.'));
        }

        // reset password
        $user = $this->userRepository->resetPassword($user, $password);

        if ($user) {
            return back()->with('status', __('Reset password successfully.'));
        }

        return back()->with('error', __('Reset password failed.'));
    }

    /**
     * 
     */
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }

}