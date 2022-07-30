<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubjectController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Subjects';
        $this->resources = 'admins.subjects.';
        parent::__construct();
        $this->route = 'subjects.';
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
            $data = Subject::orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('templates.index_actions', [
                        'id' => $data->id, 'route' => $this->route
                    ])->render();
                })
                ->rawColumns(['action'])
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
//        $request->validate([
//            'name' => 'required',
//        ]);

        foreach ($request->names as $name)
        {
            $subject = new Subject();
            $subject->grade_id = $request->grade_id;
            $subject->name = $name;
            $subject->save();
        }

        return redirect()->route($this->indexRoute());
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
        $info['item'] = Subject::findOrFail($id);
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
        $info['item'] = Subject::findOrFail($id);
        $info['grades'] = Grade::all();
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
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        $admin = Subject::findOrFail($id);
        $admin->update($data);
        return redirect()->route($this->indexRoute())->with('success', 'Admin Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Subject::findOrFail($id);
        $admin->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Admin Deleted Successfully');
    }
}
