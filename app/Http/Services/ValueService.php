<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Services;

use \Repositories\ValueRepository;
use Illuminate\Database\DatabaseManager;
use \Illuminate\Database\Eloquent\Model;
use App\Http\Models\Value;

/**
 * Description of ValueService
 *
 * @author yasser.mohamed
 */
class ValueService extends BaseService
{
    public function __construct(DatabaseManager $database, ValueRepository $repository)
    {
        $this->setDatabase($database);
        $this->setRepository($repository);
    }

    public function prepareCreate(array $data)
    {
        $this->repository->create($data);
    }

    public function prepareUpdate(Model $model, array $data)
    {
        $this->repository->update($data, $model->id);
    }

    public function prepareDelete(int $id)
    {
        $this->repository->delete($id);
    }

         /**
     * Return All records of this model
     *
     * @return mixed
     */
    public function getPagedList($filter)
    {
        $params = (object)$filter->SearchObject;
        $criteria = new SectionCriteria($params);
        $withExpressions = array();
        
        if (!property_exists($filter,"SortBy")) {
            $filter->SortBy = "id";
        }
        if (!property_exists($filter,"SortDirection")) {
            $filter->SortDirection = "DESC";
        }
        return $this->repository->getPagedResults($filter->PageNumber, $filter->PageSize,$withExpressions,$criteria,$filter->SortBy,$filter->SortDirection);
    }

    public function filterByCode($filter){

        $params = (object)$filter->SearchObject;
        if (!property_exists($filter,"SortBy")) {
            $filter->SortBy = "id";
        }
        if (!property_exists($filter,"SortDirection")) {
            $filter->SortDirection = "ASC";
        }

        return $this->repository->filterByCode($filter->PageNumber, $filter->PageSize, $params->code,$filter->SortBy,$filter->SortDirection);
    }
    
    public function getRealData(){
        return $this->repository->getData();
    }
}