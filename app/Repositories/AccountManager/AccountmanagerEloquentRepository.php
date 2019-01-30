<?php
namespace App\Repositories\AccountManager;

use App\Repositories\EloquentRepository;
use Auth;

class AccountmanagerEloquentRepository extends EloquentRepository implements AccountManagerRepositoryInterface
{
    public function getModel()
    {
        return AccountManager::class;
    }

}