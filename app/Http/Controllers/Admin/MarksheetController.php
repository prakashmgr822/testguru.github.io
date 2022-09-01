<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Marksheet;
use App\Models\Test;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MarksheetController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Marksheets';
        $this->resources = 'admins.marksheets.';
        parent::__construct();
        $this->route = 'marksheets.';
//        parent::generateAllMiddlewareByPermission('menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $info = $this->crudInfo();
        $info['id'] = $request->id;
        $info['tests'] = Test::all();


        if ($request->ajax()) {
            if ($request->test_id)
            {
                $data = Marksheet::where('test_id', $request->test_id)
                    ->orderBy('id', 'DESC')->get();
            }
            elseif ($request->dropdown_id)
            {
                $data = Marksheet::where('test_id', $request->dropdown_id)
                    ->orderBy('id', 'DESC')->get();
            }
            else{
                $data = Marksheet::orderBy('id', 'DESC')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('test_id', function ($data){
                    return $data->test_id ?? '-';

                })
                ->addColumn('college_name', function ($data){
                    return $data->college_name ?? '-';
                })
                ->addColumn('name', function ($data){
                    return $data->name ?? '-';
                })
                ->addColumn('phone', function ($data){
                    return $data->phone ?? '-';
                })
                ->addColumn('address', function ($data){
                    return $data->address ?? '-';
                })
                ->addColumn('level', function ($data){
                    return $data->level ?? '-';
                })
                ->rawColumns(['name', 'college_name', 'address', 'level', 'phone', 'test_id'])
                ->make(true);
        }

        $info['hideCreate']= true;
        return view($this->indexResource(), $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
