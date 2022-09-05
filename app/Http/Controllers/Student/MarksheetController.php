<?php

namespace App\Http\Controllers\Student;

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
        $this->resources = 'students.marksheets.';
        parent::__construct();
        $this->route = 'marksheet.';
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
        $info['tests'] = Test::where('grade_id', auth('web')->user()->grade_id)->get();

        if ($request->ajax()) {
            if ($request->test_id)
            {
                $data = Marksheet::where('test_id', $request->test_id)
                    ->where('student_id', auth('web')->user()->id)
                    ->orderBy('id', 'DESC')->get();
            }
            elseif ($request->dropdown_id)
            {
                $data = Marksheet::where('test_id', $request->dropdown_id)
                    ->where('student_id', auth('web')->user()->id)
                    ->orderBy('id', 'DESC')->get();
            }
            else{
                $data = Marksheet::where('student_id', auth('web')->user()->id)
                    ->orderBy('id', 'DESC')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('test_id', function ($data){
                    return $data->test->name;
                })

                ->addColumn('name', function ($data){
                    return $data->student->name ?? '-';
                })
                ->addColumn('grade', function ($data){
                    return $data->student->grade->name ?? '-';
                })

                ->rawColumns(['name', 'grade', 'phone', 'test_id'])
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
