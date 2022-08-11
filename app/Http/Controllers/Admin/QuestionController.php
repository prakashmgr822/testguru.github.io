<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuestionController extends BaseController
{

    public function __construct()
    {
        $this->title = 'Questions';
        $this->resources = 'admins.questions.';
        parent::__construct();
        $this->route = 'questions.';
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
            $data = Question::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('answer', function ($row) {
                    if ($row->answer == "1") {
                        $answer = "A";
                    } elseif ($row->answer == "2") {
                        $answer = "B";
                    } elseif ($row->answer == "3") {
                        $answer = "C";
                    } elseif ($row->answer == "4") {
                        $answer = "D";
                    }
                    return $answer;
                })
                ->editColumn('option_1', function ($row) {
                    $data = $row->option_1;
                    return $data;
                })
                ->addColumn('action', function ($data) {
                    return view('templates.index_actions', [
                        'id' => $data->id, 'route' => $this->route
                    ])->render();
                })
                ->rawColumns(['action', 'question', 'option_1', 'option_2', 'option_3', 'option_4', 'hint', 'answer'])
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
        $info['subjects'] = Subject::all();
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
        $request->validate([
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
        ]);
        $data = $request->all();
        $admin = new Question($data);
        $admin->save();
        return redirect()->route($this->indexRoute())->with('success', 'Question Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = $this->crudInfo();
        $info['item'] = Question::findOrFail($id);
        return view($this->showResource(), $info);
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
        $info['item'] = Question::findOrFail($id);
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
        $question = Question::findOrFail($id);
        $question->update($data);
        return redirect()->route($this->indexRoute())
            ->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route($this->indexRoute())
            ->with('info', 'Question deleted successfully.');
    }
}
