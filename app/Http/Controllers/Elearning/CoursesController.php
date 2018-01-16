<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\WordList;
use App\Traits\ElearningProcessDatabase;

class CoursesController extends Controller
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
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        try {
            $data['course'] = $course;
            $data['categoriesParent'] = $this->getCategoriesParent($course);

            // get top 10 user by score
            $data['studies'] = $course->studies()->orderBy('score', 'desc')->take(config('setting.topUser'))->get();

            $idLessons = $course->lessons->pluck('id')->all();
            $data['wordLists'] = WordList::wordlistOfLesson($idLessons)->get();
            $data['isActiveCourse'] = false;
             
            $data = $this->processUserLogin($course, $data);
            
            return view('elearning.course-detail', compact('data'));
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
}
