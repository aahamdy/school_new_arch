<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Services\ValueService;

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
        $values = $this->valueService->getRealData();
        return view('admin.index', compact('values'));
        
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
    public function update(Request $request, $id)
    {
        $json = json_decode($request->get('data', []));
        $data = (array) $json;
        $this->valueService->update($id, $data);
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