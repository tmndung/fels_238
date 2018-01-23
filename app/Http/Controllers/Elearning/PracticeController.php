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

class PracticeController extends Controller
{
    use ElearningProcessDatabase;

    public function practiceLesson(Request $request, $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $idTest = $lesson->tests()->pluck('id');
            $questions = Question::whereIn('test_id', $idTest)->get();
            if ($questions->count() > config('setting.default_question')) {
            	$questions = $questions->random(config('setting.default_question'));
            }
            $request->session()->put('numberQuestion', $questions->count());
            $question = $questions->random();
            $answers = $question->answers()->get();
            $request->session()->put('questionsPractice', $questions);
            $request->session()->put('numberCorrect', config('setting.numberCorrect'));
            $request->session()->put('ajaxPracticeRole', config('setting.ajaxPracticeLesson'));

            return view('elearning.practice.index', compact('question', 'answers', 'time', 'lesson'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function practiceCourse(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $lessons = $course->lessons;
            foreach ($lessons as $key => $lesson) {
                $idTest[$key] = $lesson->tests()->pluck('id');
            }
            $questions = Question::whereIn('test_id', $idTest)->get();
            if ($questions->count() > config('setting.default_question')) {
                $questions = $questions->random(config('setting.default_question'));
            }
            $request->session()->put('numberQuestion', $questions->count());
            $question = $questions->random();
            $answers = $question->answers()->get();
            $request->session()->put('questionsPractice', $questions);
            $request->session()->put('numberCorrect', config('setting.numberCorrect'));
            $request->session()->put('ajaxPracticeRole', config('setting.ajaxPracticeCourse'));

            return view('elearning.practice.index', compact('question', 'answers', 'time', 'lesson'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $questions = $request->session()->get('questionsPractice');
            if ($request->answered) {
                foreach ($questions as $key => $question) {
                    if ($question == Question::findOrFail($request->questionId)) {
                        $questions->forget($key);
                        break;
                    }
                }
            }
            if ($questions->isEmpty()) {
                return redirect()->route('elearning.practice.result', $id);
            }
            $question = $questions->random();
            $answers = $question->answers()->get();
            $request->session()->put('questionsPractice', $questions);

            return view('elearning.practice.show', compact('question', 'answers'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function result(Request $request, $id)
    {
        try {
            $lesson = Test::findOrFail($id)->lesson;
            $course = $lesson->course;
            $numberCorrect = $request->session()->get('numberCorrect');
            $numberQuestion = $request->session()->get('numberQuestion');
            $request->session()->forget('numberCorrect');
            $request->session()->forget('numberQuestion');

            $routeRedirect = route('elearning.courses.lesson.show', [$course->id, $lesson->id]);
            if ($request->session()->get('ajaxPracticeRole') == config('setting.ajaxPracticeCourse')) {
                $routeRedirect = route('elearning.courses.show', [$course->id]);
            }
            $request->session()->forget('ajaxPracticeRole');

            return view('elearning.practice.result', compact('numberCorrect', 'numberQuestion', 'course', 'lesson', 'routeRedirect'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
