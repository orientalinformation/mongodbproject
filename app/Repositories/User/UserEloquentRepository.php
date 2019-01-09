<?php
namespace App\Repositories\User;

use App\Model\User;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function checkExistsByKey($key, $value)
    {
        return User::where($key, $value)->exists();
    }

    public function getUserByKey($key, $value, $company_id = null)
    {
        if (!empty($company_id)) {
            $user = User::where($key, $value)
                        ->where('company_id', $company_id)
                        ->with('role')
                        ->first();
        } else {
            $user = User::where($key, $value)
                        ->with('role')
                        ->first();
        }

        return $user;
    }

    public function getUsersByOptions($options = [])
    {

        if (count($options) > 0) {
            foreach ($options as $key => $option) {
                if (count($option) == 2 && empty($option[1]))
                    unset($options[$key]);
            }

           return User::where($options)->get();
        }

        return response('User Not found', 404);
    }

    public function resetPassword($user, $password) {

        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));

        // reset token in password reset 
        app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);

        if ($user->save()) {
            return $user; 
        }
        return false;
    }
}