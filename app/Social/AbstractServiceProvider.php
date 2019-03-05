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

            $user = User::find($social->user_id);
            return $this->login($user);
        } else {
            
            $role = Role::where('name', 'user')->first();
            $accountManager = AccountManager::where('name', 'Access')->first();

            $data['fullname'] = $data['name'];
            $data['avatar'] = $data['avatar_social'] ?? null;
            $data['role_id'] = $role->id;
            $data['account_id'] = $accountManager->id;
            $data['username'] = "social_".now()->timestamp;
            $data['password'] = Hash::make('social');
            $data['gender'] = 1;
            $data['is_admin'] = 0;
            $data['email'] = $data['email'] ?? null;

            if (!empty($data['email'])) {
                $user = User::firstOrCreate(['email'=>$data['email']], $data);
            } else {
                $user = User::create($data);    
            }

            if (!empty($user->id)) {
                $data['user_id'] = $user->id;

                if (UserSocial::create($data)) {
                    return $this->login($user);
                }
            }
        }
    }
};