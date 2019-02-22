<?php
namespace App\Repositories\UserSocial;

use App\Model\User;
use App\Model\UserSocial;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;

class UserSocialEloquentRepository extends EloquentRepository implements UserSocialRepositoryInterface
{
    public function getModel()
    {
        return UserSocial::class;
    }

    public function getUserSocialByProviderAndProviderId($provider, $providerId)
    {
        return UserSocial::where('provider', $provider)->where('provider_id', $providerId)->first();
    }
}