<?php

namespace App\Social;

use App\Model\User;
use Socialite;

class GoogleServiceProvider extends AbstractServiceProvider
{
   /**
     *  Handle google response
     * 
     *  @return Illuminate\Http\Response
     */
    public function handle()
    {
        $user = Socialite::driver('google')->user();

        if (!empty($user)) {
            $data['provider'] = 'google';
            $data['provider_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] =$user->email;
            $data['avatar_social'] = $user->avatar;
        }

        return $this->loginSocial($data);
    }       
}
