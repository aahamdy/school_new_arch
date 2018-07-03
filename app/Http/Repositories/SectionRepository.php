<?php

namespace Repositories;

/**
 * Manage all Section Table custom Operations
 *
 * @author yasser.mohamed
 */
class SectionRepository extends BaseRepository
{

    /**
     * Determine the model of the repository
     *
     */
    public function model()
    {
        return 'Models\Section';
    }

    public function filterByCode($pageNumber,$pageSize,$code,$sortBy,$sortDirection){
         $query = $this->model->selectRaw("*")->where('code', '=', $code);
         return $this->getPagedQueryResults($pageNumber, $pageSize, $query,$sortBy,$sortDirection);

    }
}