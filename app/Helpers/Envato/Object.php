<?php

namespace App\Helpers\Envato;
use App\Repositories\ReadAfter\ReadAfterRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Auth;


class ObjectService
{
    
    /**
     * @var ReadAfterRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $readafterRepository;

    /**
     * Instantiate ObjectDetail service.
     *
     * @param ReadAfterRepositoryInterface $readafterRepository
     * @return void
     */
    public function __construct(ReadAfterRepositoryInterface $readafterRepository)
    {
        $this->readafterRepository = $readafterRepository;
    }

    /**
     * Get data object item detail
     *
     * @param string $id
     * @param string $type
     * @param object $repositoryName
     * @return array
     */
    public function getDataObjectDetail($id, $type, $repositoryName)
    {
        $result = [
            'read' => 0,
            'like' => 0,
            'share' => 0,
            'pink' => 0,
        ];
        $typeConst = strtoupper($type);
        $readAfter = $this->readafterRepository->getDataObjectItem($id, $typeConst);
        if ($readAfter) {
            $result['read'] = $readAfter->is_delete == 0 ? 1 : 0;
        }

        switch ($type) {
            case 'product':
                $objectDetail = $repositoryName->getDataItemRepoUser('product_id', $id);
                break;
        }
        
        if ($objectDetail) {
            $result['like'] = $objectDetail->is_like;
            $result['share'] = $objectDetail->share;
            $result['pink'] = $objectDetail->pink;
        }

        return $result;
    }

    /**
     * Set data object item detail
     *
     * @param string $id
     * @param string $type
     * @param string $element
     * @param object $repositoryName
     * @param object $repositoryDetailName
     * @return array
     */
    public function setDataObjectDetail($id, $type, $element, $repositoryName, $repositoryDetailName)
    {
        $result = true;
        $typeConst = strtoupper($type);

        $product = $repositoryName->find($id);
        $objectDetail = $repositoryDetailName->getDataItemUser($id);
        switch ($element) {
            case 'like':
                if ($objectDetail) {
                    $objectDetail->is_like = ($objectDetail->is_like == 0) ? 1 : 0;
                    $objectDetail->save();
                    
                    //update product count like
                    if ($objectDetail->is_like == 1) {
                        $result = true;
                        $product->like = $product->like + 1;
                    } else {
                        $result = false;
                        $product->like = $product->like - 1;
                    }

                    $product->save();
                } else {
                    $data['product_id'] = $id;
                    $data['user_id'] = Auth::user()->id;
                    $data['is_like'] = 1;
                    $data['share'] = 0;
                    $data['pink'] = 0;
                    $data['is_public'] = 1;
                    $data['is_delete'] = 0;

                    //insert product detail
                    $repositoryDetailName->create($data);
                    
                    //update product count like
                    $product->like = $product->like + 1;
                    $product->save();
                    $result=  true;
                }

                break;

            case 'share':
                if ($objectDetail) {
                    $objectDetail->share = ($objectDetail->share == 0) ? 1 : 0;
                    $objectDetail->save();

                    if ($objectDetail->share == 1) {
                        $result = true;
                    } else {
                        $result = false;
                    }
                } else {
                    $data['product_id'] = $id;
                    $data['user_id'] = Auth::user()->id;
                    $data['is_like'] = 0;
                    $data['share'] = 1;
                    $data['pink'] = 0;
                    $data['is_public'] = 1;
                    $data['is_delete'] = 0;

                    //insert product detail
                    $repositoryDetailName->create($data);
                    $result = true;
                }

                break;

            case 'pink':
                if ($objectDetail) {
                    $objectDetail->pink = ($objectDetail->pink == 0) ? 1 : 0;
                    $objectDetail->save();

                    if ($objectDetail->pink == 1) {
                        $result = true;
                    } else {
                        $result = false;
                    }
                } else {
                    $data['product_id'] = $id;
                    $data['user_id'] = Auth::user()->id;
                    $data['is_like'] = 0;
                    $data['share'] = 0;
                    $data['pink'] = 1;
                    $data['is_public'] = 1;
                    $data['is_delete'] = 0;

                    //insert product detail
                    $repositoryDetailName->create($data);
                    $result = true;
                }

                break;
            
            case 'read':
                $readAfter = $this->readafterRepository->getDataObjectItem($id, $typeConst);
                if ($readAfter) {
                    $readAfter->is_delete = ($readAfter->is_delete == 0) ? 1 : 0;
                    $readAfter->save();

                    if ($readAfter->is_delete == 0) {
                        $result = true;
                    } else {
                        $result = false;
                    }
                } else {
                    $data['user_id'] = Auth::user()->id;
                    $data['object_id'] = $id;
                    $data['type_name'] = $typeConst;
                    $data['is_delete'] = 0;
                    $data = $this->readafterRepository->create($data);
                    $result = true;
                }

                break;
        }

        return $result;
    }
}
