<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Tests';
        $this->resources = 'admins.tests.';
        parent::__construct();
        $this->route = 'tests.';
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
        if ($request->ajax()) {
            $data = Test::orderBy('id', 'DESC')->get();
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
                ->editColumn('description', function ($data) {
                    if ($data->description) {
                        return $data->description;
                    } else {
                        return 'N/A';
                    }
                })
                ->editColumn('created_at', function ($data) {
                        return $data->created_at->diffForHumans();
                })
                ->addColumn('action', function ($data) {
                    return view('templates.index_actions', [
                        'id' => $data->id, 'route' => $this->route, 'hideShow' => true
                    ])->render();
                })
                ->rawColumns(['action', 'description', 'exam_duration', 'created_at'])
                ->make(true);
        }
        $info = $this->crudInfo();
        return view($this->indexResource(), $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = $this->crudInfo();
        return view($this->createResource(), $info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $test = new Test($data);
        $test->save();
//        if ($request->image) {
//            $test->addMediaFromRequest('image')
//                ->toMediaCollection();
//        }
        return redirect()->route($this->indexRoute())
            ->with('success', 'Test created successfully.');
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
        $info = $this->crudInfo();
        $info['item'] = Test::with('questions')->findOrFail($id);
        $info['grades'] = Grade::with('subjects')->get();

        return view($this->editResource(), $info);
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
        $data = $request->all();
        $test = Test::findOrFail($id);
        $test->update($data);
        return redirect()->route($this->indexRoute())->with('success', 'Test updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Test Deleted Successfully.');
    }

    public function addQuestion(Request $request, $id) {
        $info = $this->crudInfo();
        $info['item'] = Test::findOrFail($id);
        $info['data'] = $request->all();


        if ($request->subject_id === "-1") {
                $questionIds = Question::whereHas('subject', function ($q) use ($request) {
                    $q->where('grade_id', $request->grade_id);
                })
                    ->InRandomOrder()
                    ->limit($request->get('count_question', 5))
                    ->pluck('id')->toArray();
        } else {
            $searchSubjectIds = [$request->subject_id];

            $questionIds = Question::whereIn('subject_id', $searchSubjectIds)
                ->InRandomOrder()
                ->limit($request->get('count_question', 5))->pluck('id')->toArray();
        }
        if ($request->random_order) {
            shuffle($questionIds);
        }
        $info['test'] = $info['item']->questions()->sync($questionIds, false);
        return redirect()->route('tests.edit', $id)
            ->with('info', 'Question added successfully.');
    }
}
