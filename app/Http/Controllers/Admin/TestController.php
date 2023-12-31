<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Question;
use App\Models\QuestionTest;
use App\Models\Subject;
use App\Models\Test;
use App\Models\User;
use App\Notifications\TestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Pusher\Pusher;
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
            $data = Test::where('admin_id', auth('admins')->user()->id)
            ->orderBy('id', 'DESC')->get();
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
                        'id' => $data->id, 'route' => $this->route, 'hideShow' => true,
                        'actions' => [
                            $examLink
                        ]
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
        $info['grades'] = Grade::all();
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
        $test->admin_id = auth('admins')->user()->id;
        $test->save();
        $students = User::where('grade_id', $test->grade_id)->get();

        foreach ($students as $student){
            try {
                $student->notify(new TestNotification($test));
            }
            catch (\Exception $e){

            }
        }

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
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $info = $this->crudInfo();
        $info['item'] = Test::with('questions')->findOrFail($id);
        $info['grades'] = Grade::with('subjects')->get();

//        if ($request->all()) {
//            dd($request->all());
//        }

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


        if ($request->subject_id) {
                $questionIds = Question::whereHas('subject', function ($q) use ($request) {
                    $q->where('grade_id', $request->grade_id);
                })
                    ->InRandomOrder()
                    ->limit($request->get('count_question', 5))
                    ->pluck('id')->toArray();
        }
        if ($request->random_order) {
            shuffle($questionIds);
        }
        $info['item']->grade_id = $request->grade_id;
        $info['item']->update();

        $info['item']->questions()->sync($questionIds, false);
        return redirect()->route('tests.edit', $id)
            ->with('info', 'Question added successfully.');
    }

    public function deleteQuestion($question_id, $test_id)
    {
        $question = QuestionTest::where('question_id' , '=',$question_id);
        $question->where('test_id', '=', $test_id);
        $question->delete();

        return redirect()->back()
            ->with('info', 'Question deleted successfully.');
    }

    public function checkStatus(Request $request)
    {
        dd($request->all());
    }
}
