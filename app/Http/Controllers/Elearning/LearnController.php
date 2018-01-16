<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Session;
use App\Traits\ElearningProcessDatabase;
use Exception;

class LearnController extends Controller
{
    use ElearningProcessDatabase;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course, Lesson $lesson)
    {
        try {
            if ($this->checkLessonCurrent($course, $lesson)) {
                return redirect()->route('elearning.courses.lesson.show', [$course->id, $lesson->id]);
            }

            if (Session::has('wordLearned')) {
                Session::forget('wordLearned'); 
            }

            $idWordlist = $lesson->wordLists()->pluck('id')->random();
            $word = $lesson->wordLists()->where('id', $idWordlist)->first();

            $wordLearned = [];
            array_push($wordLearned, $idWordlist);
            Session::put('wordLearned', $wordLearned);

            //calculate offset percent of 1 progress
            $learnTimes = config('setting.learnTimes');
            $offsetProgress = round((1 / (count($lesson->wordLists) * $learnTimes)) * config('setting.percent'));
            Session::put('learnTimes', $learnTimes);
            $progressVal = config('setting.progressValDefault');

            return view('elearning.learn', compact([
                'word',
                'lesson',
                'progressVal',
                'offsetProgress',
                'course'
            ]));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
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
    public function show(Course $course, Lesson $lesson)
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

    public function ajaxLearning(Request $request)
    {
        try {
            $dataRequest = $request->only([
                'lesson_id',
                'course_id',
                'offsetProgress',
                'progress',
            ]);

            $lesson = Lesson::findOrFail($dataRequest['lesson_id']);
            $course = Course::findOrFail($dataRequest['course_id']);
            $offsetProgress = $dataRequest['offsetProgress'];
            $progressVal = $dataRequest['progress'] + $offsetProgress;
            $wordLearned = [];

            if (Session::has('wordLearned')) {
                $wordLearned = Session::get('wordLearned');
                if (count($wordLearned) == count($lesson->wordLists)) {
                    $wordLearned = [];
                    $learnTimes = Session::get('learnTimes') - 1;
                    if (!$learnTimes) {    
                        Session::forget('learnTimes');
                        Session::forget('wordLearned');
                        
                        return $this->updateStudyLesson($course, $lesson);
                    }
                    Session::put('learnTimes', $learnTimes);
                }   
            }

            do {
                $idWordlist = $lesson->wordLists()->pluck('id')->random();
            } while (in_array($idWordlist, $wordLearned));

            $word = $lesson->wordLists()->where('id', $idWordlist)->first();
            array_push($wordLearned, $idWordlist);
            Session::put('wordLearned', $wordLearned);

            return view('templates.ajax.learning', compact([
                'word',
                'lesson',
                'progressVal',
                'offsetProgress',
                'course',
            ]));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
