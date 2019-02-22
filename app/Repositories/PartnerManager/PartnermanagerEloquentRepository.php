<?php
namespace App\Repositories\PartnerManager;

use App\Repositories\EloquentRepository;
use App\Model\Partner;
use Auth;

class PartnermanagerEloquentRepository extends EloquentRepository implements PartnerManagerRepositoryInterface
{
    public function getModel()
    {
        return Partner::class;
    }


}