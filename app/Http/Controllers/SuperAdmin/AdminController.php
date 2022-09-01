<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class AdminController extends BaseController
{

    public function __construct()
    {
        $this->title = 'Admins';
        $this->resources = 'superAdmin.admins.';
        parent::__construct();
        $this->route = 'admins.';
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
            $data = Admin::orderBy('id', 'DESC')->get();
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
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|string',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $admin = new Admin($data);
        $admin->save();
        return redirect()->route($this->indexRoute())->with('success', 'Admin Created Successfully.');
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
        $info['item'] = Admin::findOrFail($id);
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
        $info['item'] = Admin::findOrFail($id);

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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8|string',
        ]);
        $admin = Admin::findOrFail($id);
        $data = $request->all();
        if($request->password !== null){
            $data['password'] = bcrypt($request->password);
        }else{
            $data['password'] = $admin->password;
        }
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
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Admin Deleted Successfully');
    }
}
