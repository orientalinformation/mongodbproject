<?php
namespace App\Repositories\User;

use App\Model\User;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    /**
     * check Exists By Key
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function checkExistsByKey($key, $value)
    {
        return User::where($key, $value)->exists();
    }

    /**
     * get User By Key
     *
     * @param [type] $key
     * @param [type] $value
     * @param [type] $company_id
     * @return void
     */
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

    /**
     * get Users By Options
     *
     * @param array $options
     * @return void
     */
    public function getUsersByOptions($options = [])
    {

        if (count($options) > 0) {
            foreach ($options as $key => $option) {
                if (count($option) == 2 && empty($option[1]))
                    unset($options[$key]);
            }

           return User::where($options)->get();
        }

        return false;
    }

    /**
     * reset password of user
     *
     * @param [type] $user
     * @param [type] $password
     * @return void
     */
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

    /**
     * list Users By Role of user login
     *
     * @param integer $limit
     * @return void
     */
    public function listUsersByRole($limit = 20)
    {
        // get role of user login
        $roleName = Auth::user()->role->name;
        $roleId = Auth::user()->role->id;
        $userId = Auth::user()->id;
        
        return User::where('id', '!=', 0)
                    ->with('role')
                    ->orderBy('updated_at', 'desc')
                    ->paginate($limit);
    }
}