<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Services;

use \Repositories\SectionRepository;
use Repositories\SectionSubjectRepository;
use Illuminate\Database\DatabaseManager;
use \Illuminate\Database\Eloquent\Model;
use Repositories\Criterias\SectionCriteria;

/**
 * Description of SectionService
 *
 * @author yasser.mohamed
 */
class SectionService extends BaseService
{
    public $sectionSubjectRepository;

    public function __construct(DatabaseManager $database, SectionRepository $repository, SectionSubjectRepository $sectionSubjectRepository)
    {
        $this->setDatabase($database);
        $this->setRepository($repository);
        $this->sectionSubjectRepository = $sectionSubjectRepository;
    }

    public function prepareCreate(array $data)
    {
        $section = $this->repository->create($data);
        if (isset($data['sectionSubjects'])) {
            foreach ($data['sectionSubjects'] as &$obj) {
                $data = (array) $obj;
                $this->sectionSubjectRepository->create($data);
            }
        }

        return $section;
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
        $withExpressions = array("sectionSubjects");
        
        if (!property_exists($filter,"SortBy")) {
            $filter->SortBy = "id";
        }
        if (!property_exists($filter,"SortDirection")) {
            $filter->SortDirection = "ASC";
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
    
}