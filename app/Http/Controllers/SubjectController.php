<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Services\SubjectService;

/**
 * Description of SubjectController
 *
 * @author yasser.mohamed
 */
class SubjectController extends Controller
{
    /**
     * @var section
     */
    private $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function index()
    {
        return \Response::json($this->subjectService->getAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return \Response::json($this->subjectService->getById($id, ['name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $json = json_decode($request->get('data', []));
        $data = (array) $json;
        
        $this->subjectService->create($data);
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

        $this->subjectService->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->subjectService->delete($id);
    }
}