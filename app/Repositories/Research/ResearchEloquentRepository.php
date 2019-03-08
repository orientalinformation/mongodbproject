<?php

namespace App\Repositories\Research;

use App\Repositories\EloquentRepository;
use App\Model\Research;

class ResearchEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Research::class;
    }

    
}
