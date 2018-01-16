<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Traits\ElearningProcessDatabase;
use Illuminate\Support\Facades\Auth;
use Session;
use Exception;

class LessonController extends Controller
{
    use ElearningProcessDatabase;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Lesson $lesson)
    {
        try {
            $data['course'] = $course;
            $data['lesson'] = $lesson;
            $data['categoriesParent'] = $this->getCategoriesParent($course);

            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->firstOrCreate([
                'user_id' => Auth::user()->id,
                'course_id'=> $course->id,
            ]);

            $idLessonsFinished = $studyOfUser->lessons()->where('is_finish', true)->pluck('lesson_id')->all();

            // if current lesson dont finished
            if (!in_array($lesson->id, $idLessonsFinished)) {
                $data = $this->getLessonLearnedRecentOrCreate($data, $studyOfUser, $idLessonsFinished);
            }

            $data = $this->processLesson($data, $studyOfUser, $idLessonsFinished);

            return view('elearning.lesson', compact('data'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
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

    public function ajaxChangeLesson(Request $request) {
        try {
            $dataRequest = $request->only([
                'course_id',
                'lesson_id',
                'animate',
            ]);
            $data['animate'] = $dataRequest['animate'];
            $course = Course::findOrFail($dataRequest['course_id']);
            $data['course'] = $course;
            $data['lesson'] = $course->lessons()->where('id', $dataRequest['lesson_id'])->first();
            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
            $idLessonsFinished = $studyOfUser->lessons()->where('is_learned', true)->pluck('lesson_id')->all();

            $data = $this->processLesson($data, $studyOfUser, $idLessonsFinished);

            return view('templates.ajax.change-lesson', compact('data'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
