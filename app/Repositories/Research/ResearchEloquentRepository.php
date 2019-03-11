<?php

namespace App\Repositories\Research;

use App\Repositories\EloquentRepository;
use App\Model\Research;
use App\Model\User;
use Auth;
use Carbon\Carbon;

class ResearchEloquentRepository extends EloquentRepository implements ResearchRepositoryInterface
{
    public function getModel()
    {
        return Research::class;
    }

    /**
     * Save key searching value
     * @param $request
     * @return bolean
     */
    public function saveKeySearchingValue($request)
    {
        $research = new Research();
        $research->user_id = Auth::user()->id;
        $research->name = $request['name'];
        $research->keyword = $request['keyword'];
        $research->is_delete = 0;
        $research->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $research->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        return $research->save();
    }
}
