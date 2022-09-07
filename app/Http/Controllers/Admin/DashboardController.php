<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Chapter;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['questions'] = Question::where('admin_id', auth('admins')->user()->id)->count();
        $data['tests'] = Test::where('admin_id', auth('admins')->user()->id)->count();
        $data['subjects'] = Subject::where('admin_id', auth('admins')->user()->id)->count();
        return view('admins.home', $data);

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

    public function changePassword()
    {
        $info['title'] = 'Change Password';
        return view('admins.changePassword', $info);
    }

    function changePasswordSave(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
        $superAdmin = Admin::findOrFail(auth('admins')->user()->id);
        if (Hash::check($request->old_password, $superAdmin->password)) {
            $superAdmin->password = Hash::make($request->new_password);
            $superAdmin->save();
            return redirect()->back()->with('success', 'Password Changed Successfully.');
        } else {
            return redirect()->back()->with('error', 'Old Password Mismatched.')->withInput($request->input());
        }
    }
}
