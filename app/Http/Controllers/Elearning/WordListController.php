<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\WordList;
use App\Traits\ElearningProcessDatabase;

class WordListController extends Controller
{

    use ElearningProcessDatabase;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $data['course'] = $course;
        $data['categoriesParentName'] = $this->getCategoriesParentName($course);

        $idLessons = $course->lessons->pluck('id');
        $data['wordLists'] = WordList::wordlistOfLesson($idLessons)->orderBy('lesson_id')->get();                
        $data['isActiveCourse'] = false;

        $data = $this->processUserLogin($course, $data);

        return view('elearning.wordlist', compact('data'));
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
    public function show($id)
    {

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

    public function ajaxFilterWordlist(Request $request)
    {
        try {
            $requestData = $request->only([
                'course_id',
                'role',
                'lesson_id',
            ]);

            $idLessons = $requestData['lesson_id'];
            $data['course'] = Course::findOrFail($requestData['course_id']);

            if (config('setting.filterSelectAllLessons') == $idLessons) {
                $idLessons = $data['course']->lessons->pluck('id')->all();
            }
            
            $queryWordlist = WordList::wordlistOfLesson($idLessons);
            $data['wordLists'] = $queryWordlist->get();
            $data['isActiveCourse'] = false;
            $data['idWordListsLearned'] = [];

            $data = $this->processUserLogin($data['course'], $data);

            switch ($requestData['role']) {
                case config('setting.filterAllWord'):
                    $data['wordLists'] = $queryWordlist->orderBy('lesson_id')->get();
                    break;
                case config('setting.filterAlphabet'):
                    $data['wordLists'] = $queryWordlist->orderBy('name')->get();
                    break;
                case config('setting.filterLearned'):
                    $data['wordLists'] = $queryWordlist->whereIn('id', $data['idWordListsLearned'])->orderBy('lesson_id')->get();
                    break;
                case config('setting.filterUnlearn'):
                    $data['wordLists'] = $queryWordlist->whereNotIn('id', $data['idWordListsLearned'])->orderBy('lesson_id')->get();
                    break;
                default:
                    throw new Exception();
                    break;
            }
            
            return view('templates.ajax.wordlist-filter', compact('data'));
        } catch (Exception $e) {

            return redirect()->route('404error');
        }
    }
}
