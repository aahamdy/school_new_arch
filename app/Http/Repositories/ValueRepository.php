<?php

namespace Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Manage all Section Table custom Operations
 *
 * @author yasser.mohamed
 */
class ValueRepository extends BaseRepository
{

    /**
     * Determine the model of the repository
     *
     */
    public function model()
    {
        return 'Models\Value';
    }

    public function filterByCode($pageNumber,$pageSize,$code,$sortBy,$sortDirection){
         $query = $this->model->selectRaw("*")->where('code', '=', $code);
         return $this->getPagedQueryResults($pageNumber, $pageSize, $query,$sortBy,$sortDirection);

    }

    public function getData() {

         return $data = DB::table('values')
        ->join('schools', 'school_id', '=', 'schools.id')
        ->join('years', 'year_id', '=', 'years.id')
        ->join('grades', 'grade_id', '=', 'grades.id')
        ->join('fees', 'fee_id', '=', 'fees.id')
        ->get();
        
    }
}