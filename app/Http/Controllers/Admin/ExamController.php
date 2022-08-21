<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function examTest(Request $request, $id)
    {

        if(!auth()->user() && !auth('admins'))
        {
            return redirect()->route('login');
        }
        else{
//            $user = \auth()->user()->id;
//        $currentUser = User::where('id',$user)->get();


            $test = Test::findOrFail($id);
            $title= $test->name;
            $questions = $test->questions;
        }
//

        return view('admins.exams.test', compact('test', 'questions','title'));
    }
}
