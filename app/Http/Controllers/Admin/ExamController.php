<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marksheet;
use App\Models\Test;
use App\Models\User;
use DateTime;
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

    function results(Request $request)
    {
        $score = 0;
        $test = Test::find($request['test_id']);
        $questions = $test->questions;
        $admin_id = $test->admin_id;
        $title = $test->name;
//        dd($test);
        $answers = array();
        $answers = json_decode($request['answers']);

        error_log("answers-->" . $request['answers']);
//        error_log("answers encode-->" . $answers);
        for ($i = 0; $i < count($questions); $i++) {
            $userAnswer = (int)$answers[$i];
            $realAnswer = $questions[$i]['answer'];
            //dd($userAnswer);
            //dd($realAnswer);
            error_log("realAnswer-->" . $realAnswer);
            error_log("userAnswer-->" . $userAnswer);
            if ($userAnswer === $realAnswer) $score++;
            $userAns[] = $userAnswer;
        }


        $percentage = intval(round(($score / count($questions)) * 100));

        $correctMarks = 0;
        $incorrectMarks = 0;
        $totalMarks = 0;
        $correct = 1;
        $incorrect = 1;
        $skipped = 1;
        $skippedMarks = 0;
        foreach ($questions as $questionIndex => $question) {
            if ($answers[$questionIndex] != "") {
                if ($question->answer == $answers[$questionIndex]) {
                    $correctMarks = $correct++;
                }
                if ($answers[$questionIndex] != "") {
                    if ($question->answer != $answers[$questionIndex]) {
                        $incorrectMarks = $incorrect++;
                    }
                }
            } else {
                $skippedMarks = $skipped++;
            }

        }
        $userId = $request['user_id'];
        $users = User::where('id', $userId)->get();
        foreach ($users as $user)
        {
            $phone=$user->phone;
            $name=$user->name;
            $address=$user->address;
        }


        $marks = ($correctMarks * $test->correct_marks);
        $totalMarks = $test->correct_marks * count($questions);
        $totalQuestions = count($questions);
        if ($request['user_id'] !== null) {
            $marksheet = Marksheet::Create([
                'test_id' => $request['test_id'],
                'student_id' => $request['user_id'],
                'correct_count' => $score,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'total_correct_questions' => $correctMarks,
                'total_incorrect_questions' => $incorrectMarks,
                'total_skipped_questions' => $skippedMarks,
                'total_questions' => $totalQuestions,
                'total_score' => $totalMarks,
                'obtained_score' => $marks > 0 ? $marks : '0',
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'admin_id' => $admin_id,
            ]);
        }


//        return $score . "/" . count($questions) . "\n" . $percentage . "%";
        return view('admins.exams.results', ['test' => $test['name'], 'score' => $score, 'total_questions' => count($questions), 'percentage' => $percentage, 'questions' => $questions, 'correctMarks' => $correctMarks, 'incorrectMarks' => $incorrectMarks, 'skippedMarks' => $skippedMarks, 'answers' => $answers, 'marks' => $marks, 'totalMarks' => $totalMarks, 'title'=> $title, 'userAns'=> $userAns]);
    }


}
