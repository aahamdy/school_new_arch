<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Services;

use \Repositories\SubjectRepository;
use Illuminate\Database\DatabaseManager;
use \Illuminate\Database\Eloquent\Model;

/**
 * Description of SectionService
 *
 * @author yasser.mohamed
 */
class SubjectService extends BaseService
{

    public function __construct(DatabaseManager $database,SubjectRepository $repository)
    {
        $this->setDatabase($database);
        $this->setRepository($repository);
    }

    public function prepareCreate(array $data)
    {
       // $this->repository->create($data);
        return $this->repository->create($data);
    }

    public function prepareUpdate(Model $model, array $data)
    {
        $this->repository->update($data,$model->id);
    }

    public function prepareDelete(int $id)
    {
        $this->repository->delete($id);
    }
}