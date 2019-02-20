<?php

namespace App\Social;

use App\Model\User;
use Socialite;

class LiveServiceProvider extends AbstractServiceProvider
{
   /**
     *  Handle MicrosoftLive response
     * 
     *  @return Illuminate\Http\Response
     */
    public function handle()
    {
        $user = Socialite::driver('live')->user();

        if (!empty($user)) {
            $data['provider'] = 'live';
            $data['provider_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] =$user->email;
            $data['avatar_social'] = $user->avatar;
        }

        return $this->loginSocial($data);
    }       
}

