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

        return $research->save();
    }

    /**
     * find item limit
     * @param $limit
     * @return mixed
     */
    public function getListItem($limit = 5)
    {
        return $this->model->where('is_delete', 0)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->limit($limit)->get();
    }
}
