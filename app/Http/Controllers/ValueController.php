<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Services\ValueService;
use App\Http\Requests\ValuesRequest;
use Models\School;
use Models\Year;
use Models\Value;
use Illuminate\Support\Facades\Input;
/**
 * Description of SectionController
 *
 * @author yasser.mohamed
 */
class ValueController extends Controller
{
    /**
     * @var section
     */
    private $valueService;

    public function __construct(ValueService $valueService)
    {
        $this->valueService = $valueService;
    }

    public function index()
    {   
        $school_id = Input::get('school_id', false);
        $year_id = Input::get('year_id', false);
        $values = $this->valueService->getData($year_id, $school_id);
        $schools = $this->valueService->getSchools();
        $years = $this->valueService->getYears();
        $fees = $this->valueService->getFees();
        $schools_name = School::pluck('name', 'id');
        $years_number = Year::pluck('year', 'id');
        return view('admin.index', compact('values','schools', 'years', 'fees', 'school_id', 'year_id','schools_name','years_number'));
    }

    public function filter()
    {
        $schools = School::pluck('name', 'id');
        $years = Year::pluck('year', 'id');
        return view('admin.filter', compact('schools', 'years'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return \Response::json($this->valueService->getById($id, ['name', 'code']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->valueService->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update()
    {   
        $values = Input::get('value');
        $grades = Input::get('grade');
        $fee_ids = Input::get('fee_id');
        $ids = Input::get('id');
        $year_id = Input::get('year_id');

        foreach ($ids as $key => $id){
            if ($id != Null){

                $data['year_id']=$year_id;
                $data['grade_id']=$grades[$key];
                $data['fee_id']=$fee_ids[$key];
                $data['value']=$values[$key];

                $this->valueService->update($id, $data);

            } else {
                $data['year_id']=$year_id;
                $data['grade_id']=$grades[$key];
                $data['fee_id']=$fee_ids[$key];
                $data['value']=$values[$key];

                $this->valueService->create($data);
            }
        }

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->valueService->delete($id);
    }

    public function getPagedList(Request $request)
    {
        $filter = (object)$request->all();
        return \Response::json($this->valueService->getPagedList($filter));
    }

    public function filterByCode(Request $request){

         $filter = (object)$request->all();
         return \Response::json($this->valueService->filterByCode($filter));
     }
     
}