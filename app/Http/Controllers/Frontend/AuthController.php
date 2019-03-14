<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserSocial\UserSocialRepositoryInterface;
use App\Repositories\AccountManager\AccountManagerRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Mail;
use Storage;
use Illuminate\Validation\Rule;
use App\Model\UserSocial;
use File;
use App\Rules\GoogleRecaptcha;
use App\Rules\CheckBase64Rule;
use App\Rules\CheckMineTypeRule;

class AuthController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var UserSocialRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $userSocialRepository;    

    /**
     * @var AccountManagerRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $accountRepository;

    /**
     * @var RoleRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $roleRepository;

    /**
     * AuthController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserSocialRepositoryInterface $userSocialRepository
     * @param AccountManagerRepositoryInterface $accountRepository
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, UserSocialRepositoryInterface $userSocialRepository, AccountManagerRepositoryInterface $accountRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->userSocialRepository = $userSocialRepository;
        $this->accountRepository = $accountRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * show Registration Form
     *
     * @param Request $request
     * @return void
     */
    public function showRegistrationForm(Request $request)
    {
        $dataSocial = null;
        $type = 'web';
        
        return view('Frontend.Auth.register', compact(['dataSocial', 'type']));
    
    }

    /**
     * register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $rules = [
            'civility'              => 'required|integer|min:0',
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'email'                 => ['required', 'email','string', 'confirmed', Rule::unique('users')],
            'email_confirmation'    => 'required|email|string',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'career'                => 'required|integer|min:0',
            'association'           => 'required|integer|min:0',
            'status'                => 'required|integer|min:0',
            'type'                  => 'required|array',
            'g-recaptcha-response'  => ['required', new GoogleRecaptcha],
            'original_image'        => [new CheckMineTypeRule],
        ];

        $messages = [
            'civility.required'             => __('validation.required', ['attribute' => "civilité"]),
            'civility.min'                  => __('validation.min.numeric', ['attribute' => "civilité", 'min' => 0]),
            'first_name.required'           => __('validation.required', ['attribute' => "nom"]),
            'last_name.required'            => __('validation.required', ['attribute' => "prénom"]),
            'email.required'                => __('validation.required', ['attribute' => "email"]),
            'email.email'                   => __('validation.email', ['attribute' => "email"]),
            'email.confirmed'               => __('validation.confirmed', ['attribute' => "email"]),
            'email.unique'                  => __('validation.unique', ['attribute' => "l'email existe déjà"]),
            'email_confirmation.required'   => __('validation.required', ['attribute' => "confirmation de l'émail"]),
            'email_confirmation.email'      => __('validation.email', ['attribute' => "confirmation de l'émail"]),
            'password.required'             => __('validation.required', ['attribute' => "mot de passe"]),
            'password.min'                  => __('validation.min.numeric', ['attribute' => "mot de passe", 'min' => 6]),
            'password.confirmed'            => __('validation.confirmed', ['attribute' => "mot de passe"]),
            'password_confirmation.required'=> __('validation.required', ['attribute' => "confirmation mot de passe"]),
            'password_confirmation.min'     => __('validation.min.numeric', ['attribute' => "confirmation mot de passe", 'min' => 6]),
            'career.required'               => __('validation.required', ['attribute' => "filière"]),
            'career.min'                    => __('validation.min.numeric', ['attribute' => "filière", 'min' => 0]),
            'association.required'          => __('validation.required', ['attribute' => "membre de l'association"]),
            'association.min'               => __('validation.min.numeric', ['attribute' => "membre de l'association", 'min' => 0]),
            'status.required'               => __('validation.required', ['attribute' => "status"]),
            'status.min'                    => __('validation.min.numeric', ['attribute' => "status", 'min' => 0]),
            'type.required'                 => __('validation.required', ['attribute' => "type"]),
            'type.array'                    => __('validation.array', ['attribute' => "type"]),
            'g-recaptcha-response.required' => __('validation.recaptcha', ['attribute' => "s'il vous plaît vérifier recaptcha"]),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $input = $request->all();
            $errors = $validator->messages();
            return view('Frontend.Auth.register', compact('input'))->withErrors($errors);
        }
        
        // check username and email exists       
        $data = $request->all();
        if ($this->userRepository->checkExistsByKey('email', trim($data['email']))) {
            return back()->withErrors(__('Le mail existe déjà.'))->withInput();  
        }

        // get account and role
        $account = $this->accountRepository->getAccountByKey('name', 'Premium');

        if (empty($account)) {
            return back()->with('error', __('Échec de la création.'));  
        }

        $role = $this->roleRepository->getRoleByKey('name', 'user');

        if (empty($role)) {
            return back()->with('error', __('Échec de la création.'));  
        }

        // Hash password
        $data["role_id"]       = $role->id;
        $data["account_id"]    = $account->id;
        $data["is_admin"]      = 0;
        $data["gender"]        = 0;
        $data["fullname"]      = $data['first_name'].' '.$data['last_name'];
        $data["birthday"]      = date("Y-m-d");
        $data["password"]      = Hash::make($data["password"]);
        $data["type"]          = json_encode($data["type"]);
        if(array_key_exists('avatar_social', $data)) {
            $data['avatar'] = $data['avatar_social'];
        }
        // upload avatar
        if(!empty($data['image_data'])) {
            $encoded    = $data['image_data'];
            $path       = storage_path().'/avatar';
            $filename   = time() . '_' . $data['original_image'];
            $base64Str  = substr($encoded, strpos($encoded, ",") + 1);
            $image      = base64_decode($base64Str);
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            File::put($path. '/' . $filename, $image);
            if(!File::isDirectory($path)) {
                symlink(storage_path().'/avatar', public_path(). '/storage/avatar');
            }
            
            $data['avatar'] = '/storage/avatar/' . $filename;
        }
        // create
        $result = $this->userRepository->create($data);

        if ($data['provider'] && !empty($result->id)) {
            // social account
            $data['user_id'] = $result->id;
            UserSocial::create($data);
        }

        if ($result) {
            auth()->login($result);
            return redirect('/home');
        }

        return back()->with('error', __('Échec de la création.'));
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
            'username.required' => __('validation.required', ['attribute' => "courriel ou pseudo"]),
            'password.required' => __('validation.required', ['attribute' => "mot de passe"]),
            'password.min'      => __('validation.min.numeric', ['attribute' => "mot de passe", 'min' => 6]),
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
            return back()->with('error', __('L\'identifiant ou le mot de passe est incorrect.'));
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

    /**
     * show Forgot Form
     *
     * @return void
     */
    public function showForgotForm()
    {
        return view('Frontend.Auth.forgot-password');
    }

    /**
     * send Mail
     *
     * @param Request $request
     * @return void
     */
    public function sendMail(Request $request)
    {
        $rules = [
            'email' => 'required|email|string',
        ];

        $messages = [
            'email.required' => __('validation.required', ['attribute' => "email"]),
            'email.email' => __('validation.email', ['attribute' => "email"]),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        // get data
        $email = $request->get('email');
        $user = $this->userRepository->getUserByKey('email', $email);

        if (!$user) {
            return back()->with('error', __("Nous ne pouvons pas trouver d'utilisateur avec cette adresse électronique."));
        }

        // create token and get url 
        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);
        $url = route('frontShowResetForm', $token);

        Mail::send('Frontend.Auth.emails.send', [
                'title' => "Hi", 
                'content' => "Vous recevez cet email car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.",
                'contentEnd' => "Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.",
                'url' => $url
            ], function ($message) use ($email)  {
            $message->from('laravel5.7.co.vn@gmail.com', 'Administrator');
            $message->to($email);
            $message->subject('Reset Password');
        });

        return back()->with('status', __('Nous avons envoyé votre lien de réinitialisation de mot de passe par courrier électronique.'));         
    }

    /**
     * show Reset Form
     *
     * @param [type] $token
     * @return void
     */
    public function showResetForm($token = null)
    {
        return view('Frontend.Auth.form-reset-password')->with(['token' => $token]);
    }

    /**
     * reset Password
     *
     * @param Request $request
     * @return void
     */
    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|string',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];

        $messages = [
            'email.required'                => __('validation.required', ['attribute' => "email"]),
            'email.email'                   => __('validation.email', ['attribute' => "email"]),
            'password.required'             => __('validation.required', ['attribute' => "mot de passe"]),
            'password.min'                  => __('validation.min.numeric', ['attribute' => "mot de passe", 'min' => 6]),
            'password.confirmed'            => __('validation.confirmed', ['attribute' => "mot de passe"]),
            'password_confirmation.required'=> __('validation.required', ['attribute' => "confirmation mot de passe"]),
            'password_confirmation.min'     => __('validation.min.numeric', ['attribute' => "confirmation mot de passe", 'min' => 6]),            
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
            return back()->with('error', __("Nous ne pouvons pas trouver d'utilisateur avec cette adresse électronique."));
        }

        // check token
        $result = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->tokenExists($user, $token);

        if (!$result) {
            return back()->with('error', __('Ce jeton de réinitialisation de mot de passe n\'est pas valide.'));
        }

        // reset password
        $user = $this->userRepository->resetPassword($user, $password);

        if ($user) {
            // return back()->with('status', __('Réinitialiser le mot de passe avec succès.'));
            auth()->login($user);
            return redirect("/home");
        }

        return back()->with('error', __('La réinitialisation du mot de passe a échoué.'));
    }    

}
