<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use Exception;

class TestController extends Controller
{
    public function index(Request $request, $id)
    {
        try {
            if (!$question = Question::where('test_id', $id)->first()) {
                throw new Exception();                
            }
            $answers = $question->answers()->get();
            $request->session()->put('offset', config('setting.offset_get_question_default'));
            $time = Test::findOrFail($id)->time;

            return view('elearning.test.index', compact('question', 'answers', 'time'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $offset = $request->session()->has('offset') ? $request->session()->get('offset') + config('setting.increase_question') : config('setting.offset_get_question_1');
            $numberAnswer = Question::where('test_id', $id)->count();
            if ($offset >= $numberAnswer) {
                $request->session()->forget('offset');
                
                return redirect()->route('elearning.test.result', $id);
            }
            $request->session()->put('offset', $offset);
            $question = Question::where('test_id', $id)->offset($offset)->first();
            $answers = $question->answers()->get();

            return view('elearning.test.show', compact('question', 'answers'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function result(Request $request, $id)
    {
        try {
            $score = $request->session()->has('score') ? $request->session()->get('score') : config('setting.score_default');
            $request->session()->forget('score');
            $scorePass = Test::findOrFail($id)->point_need_pass;

            return view('elearning.test.result', compact('score', 'scorePass', 'id'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
