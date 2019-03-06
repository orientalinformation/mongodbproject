<?php

namespace App\Social;

use App\Model\User;
use App\Model\UserSocial;
use App\Model\AccountManager;
use App\Model\Role;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

abstract class AbstractServiceProvider
{
    protected $provider;

    /**
     *  Create a new SocialServiceProvider instance
     */
    public function __construct()
    {
        $this->provider = Socialite::driver(
            str_replace(
                'serviceprovider', '', strtolower((new \ReflectionClass($this))->getShortName())
            )
        );
    }

    /**
     *  Handle data returned by the provider
     * 
     *  @return \Illuminate\Http\Response
     */
    abstract public function handle();    

    /**
     *  Redirect the user to provider authentication page
     * 
     *  @return \Illuminate\Http\Response
     */
    public function redirect()
    {

        return $this->provider->redirect();
    }

    /**
     *  Logged in the user
     * 
     *  @param  \App\Model\User $user
     *  @return \Illuminate\Http\Response
     */
    protected function login($user)
    {
        auth()->login($user);

        return redirect('/home');
    }

    /**
     * login Social
     *
     * @param [type] $data
     * @return void
     */
    public function loginSocial($data)
    {
        $social = UserSocial::where('provider', '=', $data['provider'])
                    ->where('provider_id', '=', $data['provider_id'])->first();

        if (!empty($social)) {
            // already have account
            $user = User::find($social->user_id);
            return $this->login($user);
        } else {
            
            $role                  = Role::where('name', 'user')->first();
            $accountManager        = AccountManager::where('name', 'Access')->first();
            $data['fullname']      = $data['name'];
            $data['avatar']        = $data['avatar_social'] ?? null;
            $data['role_id']       = $role->id;
            $data['account_id']    = $accountManager->id;
            $data['username']      = "social_".now()->timestamp;
            $data['password']      = Hash::make('social');
            $data['gender']        = 1;
            $data['is_admin']      = 0;
            $data['email']         = $data['email'] ?? null;
            $data['last_name']     = '';
            $data['first_name']    = '';

            if ($data['fullname']) {
                $nom = explode(" ", $data['fullname']);
                $data['last_name'] = end($nom);
                array_pop($nom);
                $data['first_name'] = implode(' ', $nom);
            }

            return $this->preRegister($data);
        }
    }

    protected function preRegister($data)
    {
        $dataSocial = null;
        $type = 'web';

        return view('Frontend.Auth.register', compact(['dataSocial', 'type', 'data']));
    }
}