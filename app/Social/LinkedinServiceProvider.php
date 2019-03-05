<?php

namespace App\Social;

use App\Model\User;
use Socialite;

class LinkedinServiceProvider extends AbstractServiceProvider
{
   /**
     *  Handle linkedin response
     * 
     *  @return Illuminate\Http\Response
     */
    public function handle()
    {
        $user = Socialite::driver('linkedin')->user();

        if (!empty($user)) {
            $data['provider'] = 'linkedin';
            $data['provider_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] =$user->email;
            $data['avatar_social'] = $user->avatar;
        }

        return $this->loginSocial($data);
    }       
}

