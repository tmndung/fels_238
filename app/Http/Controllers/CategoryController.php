<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\WordList;
use App\Http\Requests\CategoryRequest;
use App\Traits\AdminProcessDatabase;
use Exception;
use DB;

class CategoryController extends Controller
{
    use AdminProcessDatabase;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objCategories = Category::paginate(config('setting.paginate'));

        return view('admin.category.index', compact('objCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategoriesParent();

        return view('admin.category.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $columns = $request->only('name', 'parent_id');
            Category::create($columns);
            $message = trans('lang.addSuccess');
        } catch (Exception $e) {
            $message = trans('lang.errorAdd');
        }

        return redirect()->action('CategoryController@index')->with('messages', $message);
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
    public function edit(Category $category)
    {
        $categories = $this->getCategoriesParent();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $columns = $request->only('name', 'parent_id');
            $category->update($columns);
            $message = trans('lang.editSuccess');
        } catch (Exception $e) {
            $message = trans('lang.errorEdit');
        }

        return redirect()->action('CategoryController@index')->with('messages', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            DB::transaction(function () use ($category) {
                $idCategories = $category->categories()->pluck('id');
                $idCourses = Course::whereIn('category_id', $idCategories)->pluck('id');
                $idLessons = Lesson::whereIn('course_id', $idCourses)->pluck('id');
                $idWourdlists = WordList::whereIn('lesson_id', $idLessons)->pluck('id');
                $idTests = Test::whereIn('lesson_id', $idLessons)->pluck('id');
                $idQuestions = Question::whereIn('test_id', $idTests)->pluck('id');

                Answer::whereIn('question_id',  $idQuestions)->delete();
                Question::whereIn('test_id',  $idTests)->delete();
                Test::whereIn('lesson_id',  $idLessons)->delete();
                WordList::whereIn('lesson_id',  $idLessons)->delete();
                Lesson::whereIn('course_id',  $idCourses)->delete();
                Course::whereIn('category_id', $idCategories)->delete();
                $category->courses()->delete();
                $category->categories()->delete();
                $category->delete();
            });
            $message = trans('lang.delSuccess');
        } catch (Exception $e) {
            $message = trans('lang.errorDel');
        }

        return redirect()->back()->with('messages', $message);
    }
}
