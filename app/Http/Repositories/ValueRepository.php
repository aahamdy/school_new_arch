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

    public function getData($year_id, $school_id) {

        return $data = DB::table('fees')
        ->crossJoin('grades')
        ->leftJoin('values', function($join) use ($year_id)
        {
            $join->on('values.fee_id', '=', 'fees.id');
            $join->where('values.year_id', '=',DB::raw("'".$year_id."'"));
            $join->on('values.grade_id', '=', 'grades.id');
        })
        ->where('grades.school_id', '=',DB::raw("'".$school_id."'"))
        ->selectRaw('values.id as id , grades.id as grade_id, fees.id as fee_id , grades.grade as grade_name, fees.type as fee_type, IFNULL(VALUES.value,0) AS value')
        ->orderBy('grade_name', 'ASC')
        ->orderBy('fee_id', 'ASC')
        ->get();
    }

    public function getSchools() {

        return $schools = DB::table('schools')
        ->get();
    }
    
    public function getYears() {

        return $years = DB::table('years')
        ->get();

    }

    public function getFees() {

        return $fees = DB::table('fees')
        ->get();

    }

}