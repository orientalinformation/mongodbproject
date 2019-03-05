<?php

namespace App\Social;

use App\Model\User;
use Socialite;

class FacebookServiceProvider extends AbstractServiceProvider
{
   /**
     *  Handle Facebook response
     * 
     *  @return Illuminate\Http\Response
     */
    public function handle()
    {
        $user = Socialite::driver('facebook')->user();

        if (!empty($user)) {
            $data['provider'] = 'facebook';
            $data['provider_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['avatar_social'] = $user->avatar;
        }

        return $this->loginSocial($data);
    }
}