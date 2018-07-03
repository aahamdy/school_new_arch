<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Services\SectionService;

/**
 * Description of SectionController
 *
 * @author yasser.mohamed
 */
class SectionController extends Controller
{
    /**
     * @var section
     */
    private $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {

        return \Response::json($this->sectionService->getPagedResults(1,2));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return \Response::json($this->sectionService->getById($id, ['name', 'code']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->sectionService->create($request->all());
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
        $this->sectionService->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->sectionService->delete($id);
    }

    public function getPagedList(Request $request)
    {
        $filter = (object)$request->all();
        return \Response::json($this->sectionService->getPagedList($filter));
    }

     public function filterByCode(Request $request){

         $filter = (object)$request->all();
         return \Response::json($this->sectionService->filterByCode($filter));
     }
     
}