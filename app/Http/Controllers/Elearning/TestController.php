<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Traits\ElearningProcessDatabase;

class TestController extends Controller
{
    use ElearningProcessDatabase;

    public function index(Request $request, $id)
    {
        try {
            $request->session()->forget('score');
            $lesson = Lesson::findOrFail($id);
            $course = $lesson->course;
            if ($this->checkPassTest($course, $lesson)) {
                return redirect()->route('elearning.courses.lesson.show', [$lesson->course->id, $lesson->id]);
            }
            if (!$test = $lesson->tests()->inRandomOrder()->first()) {
                throw new Exception();
            }
            if (!$questions = $test->questions()->get()) {
                throw new Exception();                
            }
            $question = $questions->random();
            $answers = $question->answers()->get();
            $request->session()->put('questions', $questions);
            $time = $test->time;

            return view('elearning.test.index', compact('question', 'answers', 'time', 'lesson'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $questions = $request->session()->get('questions');
            if ($request->answered) {
                $questions = $request->session()->get('questions');
                foreach ($questions as $key => $question) {
                    if ($question == Question::findOrFail($request->questionId)) {
                        $questions->forget($key);
                        break;
                    }
                }
            }
            if ($questions->isEmpty()) {
                return redirect()->route('elearning.test.result', $id);
            }
            $question = $questions->random();
            $answers = $question->answers()->get();
            $request->session()->put('questions', $questions);

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
            $test = Test::findOrFail($id);
            $scorePass = $test->point_need_pass;
            if ($score >= $scorePass) {
                $data = [
                    'is_finish' => config('setting.is_finish'),
                    'is_learned' => config('setting.is_learned'),
                ];
                $studyOfUser = $test->lesson->course->studies()->where('user_id', Auth::user()->id)->first();
                if (!$studyOfUser->lessons()->updateExistingPivot($test->lesson->id ,$data)){
                    throw new Exception();
                }
            }
            $idLesson = $test->lesson->id;
            return view('elearning.test.result', compact('score', 'scorePass', 'idLesson'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
