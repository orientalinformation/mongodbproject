<?php
namespace App\Repositories\AccountManager;

use App\Repositories\EloquentRepository;
use App\Model\AccountManager;
use Auth;

class AccountmanagerEloquentRepository extends EloquentRepository implements AccountManagerRepositoryInterface
{
    public function getModel()
    {
        return AccountManager::class;
    }

    /**
     * Get Account By Key
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function getAccountByKey($key, $value)
    {
        return AccountManager::where($key, $value)->first();
    }
}