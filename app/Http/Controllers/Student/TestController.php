<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Tests';
        $this->resources = 'students.tests.';
        parent::__construct();
        $this->route = 'test.';
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Test::orderBy('id', 'DESC')
                ->where('grade_id', auth('web')->user()->grade_id)
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('target_date', function ($data) {
                    return Carbon::parse($data->target_date)->format("j-F-Y, H:i:s");
                })
                ->editColumn('exam_duration', function ($data) {
                    if ($data->exam_duration) {
                        return $data->exam_duration. ' (minutes)';
                    } else {
                        return 'N/A';
                    }
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {

                    $examLink = '<a target="_blank" href="' . route("test-exam", ['id' => $data->id]) . '"
                                   class="btn btn-sm btn-clean btn-icon btn-hover-info"><i
                                   class="fa fa-question-circle"></i></a>';
                    return view('templates.index_actions', [
                        'id' => $data->id, 'route' => $this->route, 'hideShow' => true, 'hideEdit' => true, 'hideDelete' => true,
                        'actions' => [
                            $examLink
                        ]
                    ])->render();
                })
                ->rawColumns(['action', 'description', 'exam_duration', 'created_at'])
                ->make(true);
        }
        $info = $this->crudInfo();
        $info['hideCreate'] = '';
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
