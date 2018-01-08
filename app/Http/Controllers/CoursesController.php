<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\WordList;
use Session;
use App\Traits\ProcessFiles;
use App\Http\Requests\CourseRequest;
use Exception;
use DB;

class CoursesController extends Controller
{
    use ProcessFiles;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate(config('setting.paginate'));

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('admin.courses.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try {
            $data = $request->only([
                'name',
                'category_id',
                'number_of_lesson',
                'information',
            ]);

            $data['picture'] = $this->storePicture($request, config('setting.picture'), '');
            Course::create($data);
            
            Session::flash('messages', trans('lang.addSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorAdd'));
        }

        return redirect()->route('admin.courses.index');
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
    public function edit(Course $course)
    {
        $categories = Category::pluck('name', 'id');

        return view('admin.courses.edit', compact(['course', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        try {
            $data = $request->only([
                'name',
                'category_id',
                'number_of_lesson',
                'information',
            ]);

            $data['picture'] = $this->storePicture($request, config('setting.picture'), $course->picture);
            $course->update($data);

            Session::flash('messages', trans('lang.editSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorEdit'));
        }

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            DB::transaction(function () use ($course) {

                $idLessons = $course->lessons()->pluck('id');
                $idWordLists = WordList::whereIn('lesson_id', $idLessons)->pluck('id');
                $idTests = Test::whereIn('lesson_id', $idLessons)->pluck('id');
                $idQuestions = Question::whereIn('test_id', $idTests)->pluck('id');
                $idAnswers = Answer::whereIn('question_id', $idQuestions)->pluck('id');

                Answer::whereIn('id', $idAnswers)->delete();
                Question::whereIn('id', $idQuestions)->delete();
                Test::whereIn('id', $idTests)->delete();
                WordList::whereIn('id', $idWordLists)->delete();
                
                $course->lessons()->delete();
                $course->delete();

            });
            
            Session::flash('messages', trans('lang.delSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorDel'));
        }

        return redirect()->route('admin.courses.index');
    }
}
