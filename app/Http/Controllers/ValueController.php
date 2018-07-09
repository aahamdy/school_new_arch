<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Services\ValueService;
use App\Http\Requests\ValuesRequest;
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
        return $values = $this->valueService->getData();
        $schools = $this->valueService->getSchools();
        $years = $this->valueService->getYears();
        $fees = $this->valueService->getFees();
        return view('admin.index', compact('values','schools', 'years', 'fees'));
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
        // return $request->all();
        $this->valueService->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ValuesRequest $request)
    {

        return $data = $request->except(['_method', '_token']);
        $data = (array) $data;

        if(empty($data['value'])){
            $data['value'] = 0;
        }

        $this->valueService->update($id, $data);
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