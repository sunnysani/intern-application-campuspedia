<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Question;

class Controller extends BaseController
{
    public function index() 
    {
        $subjects = Subject::getSubjects();

        return view('index')->with('subjects', $subjects);
    }

    public function edit($id) {
        $subject = Subject::find($id);
        $questions = $subject->getQuestions();
        
        return view('edit')
            ->with('subject', $subject)
            ->with('questions', $questions);
    }

    public function exercise($id) {
        $subject = Subject::find($id);
        $questions = $subject->getQuestions();
        
        return view('exercise')
            ->with('subject', $subject)
            ->with('questions', $questions);
    }

    public function getScore(Request $request) {
        $answers = DB::table('questions')
            ->select('answer')
            ->where('subject', '=', $request->subject_id)
            ->orderBy('id', 'asc')
            ->get()->toArray();

        $ansArray = array();
        $counter = 0;
        foreach ($answers as $item) {
            $ansArray[$counter++] = $item->answer;
        }

        $correct_count = 0;
        $counter = 0; // Counter Variable also act as QuestionCounter
        $data = $request->except('_token', 'subject_id');
        foreach ($data as $key => $value) {
            if ($ansArray[$counter++] == $value) { // if real_ans == ans
                $correct_count++;
            } 
        }

        $mark = $correct_count/$counter*100;

        return view('score')
            ->with('mark', $mark);
    }

    public function createSubject(Request $request) {
        if ($request->isMethod('post'))
        {
            $name = $request->name;
            $description = $request->description;
            $id = DB::table('subjects')->insertGetId(
                ['name' => $name, 'description' => $description]
            );
            return redirect('/edit/'.$id);
        } else
        {
            return view('create');
        }
    }

    public function createBlankQuestion(Request $request)
    {
        $id = DB::table('questions')->insertGetId(
            ['question' => 'Question',
             'option_one' => '1',
             'option_two' => '2',
             'option_three' => '3',
             'option_four' => '4',
             'option_five' => '5',
             'answer' => 1,
             'subject' => $request->get('subject_id')
            ]
        );
        return $id;
    }

    public function updateQuestion(Request $request)
    {
        // if the input is empty, means there is no change
        $changed_data = array("question_id"=>$request->get('question_id'));

        $question = $request->get('question');
        if ($request->get('question') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['question' => $request->get('question')]);
            $changed_data["question"] = $request->get('question');
        }
        if ($request->get('option_one') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['option_one' => $request->get('option_one')]);
            $changed_data["option_one"] = $request->get('option_one');
        }
        if ($request->get('option_two') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['option_two' => $request->get('option_two')]);
            $changed_data["option_two"] = $request->get('option_two');
        }
        if ($request->get('option_three') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['option_three' => $request->get('option_three')]);
            $changed_data["option_three"] = $request->get('option_three');
        }
        if ($request->get('option_four') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['option_four' => $request->get('option_four')]);
                $changed_data["option_four"] = $request->get('option_four');
        }
        if ($request->get('option_five') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['option_five' => $request->get('option_five')]);
                $changed_data["option_five"] = $request->get('option_five');
        }
        if ($request->get('answer') != "") {
            DB::table('questions')
                ->where('id', $request->get('question_id'))
                ->update(['answer' => $request->get('answer')]);
                $changed_data["answer"] = $request->get('answer');
        }
        return $changed_data;
    }

    public function deleteQuestion(Request $request)
    {
        DB::table('questions')->where('id', '=', $request->get('question_id'))->delete();
    }
}
