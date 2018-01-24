<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Exception;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Course;
use App\Models\WordList;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Study;
use Session;
use DB;

class AjaxController extends Controller
{
    public function blockFollow(Request $request)
    {
        try {
            $follow = Follow::findOrFail($request->id);
            $data ['status'] = $follow->status ? config('setting.status_follow_block') : config('setting.status_follow_default');
            $follow->update($data);
            $messages['success'] = trans('lang.editSuccess');
        } catch (Exception $e) {
            $messages['error'] = trans('lang.errorEdit');
        }
        $messages['block'] = trans('lang.block');
        $messages['unblock'] = trans('lang.unblock');

        return response()->json($messages); 
    }

    public function unFollow(Request $request)
    {
        try {
            Follow::destroy($request->id);
            $messages['success'] = trans('lang.unfollowSuccess');
        } catch (Exception $e) {
            $messages['error'] = trans('lang.unfollowFail');
        }

        return response()->json($messages); 
    }

    public function answerCorrect(Request $request)
    {
        try {
            $messages['correctId'] = Answer::where('question_id', $request->id)->where('is_correct', config('setting.is_correct_answer'))->first()->id;
            if ($request->answerId == $messages['correctId']) {
                $request->session()->put('score', $request->session()->get('score') + config('setting.increase_score'));
                $request->session()->put('numberCorrect', $request->session()->get('numberCorrect') + config('setting.increase_correct'));
            }
        } catch (Exception $e) {
            $messages['error'] = trans('lang.error');
        }

        return response()->json($messages);
    }
    public function search(Request $request)
    {
        try {
            if (!$request->search) {
                throw new Exception();
            }
            $courses = Course::where('name', 'LIKE', '%' . $request->search . '%')->limit(config('setting.number_course_search'))->get();

            return view('elearning.search', compact('courses'));
        } catch (Exception $e) {
            $error['error'] = trans('lang.not_found');

            return response()->json($error);
        }
    }

    public function contentWordlist(Request $request)
    {
        if ($request->id) {
            $objWordLists = WordList::where('lesson_id', $request->id)->orderBy('created_at', 'DESC')->paginate(config('setting.paginate'));
        } else {
            $objWordLists = WordList::orderBy('created_at', 'DESC')->paginate(config('setting.paginate'));
        }

        return view('admin.wordlist.content', compact('objWordLists'));
    }

    public function deleteWordlist(Request $request)
    {
        if (WordList::whereIn('id', $request->idWordlists)->delete()) {
            Session::flash('success', trans('lang.delSuccess'));
        } else {
            Session::flash('messages', trans('lang.errorDel'));
        }
    }

    public function deleteCategory(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $categories = Category::whereIn('id', $request->idCategories)->get();
                foreach ($categories as $category) {
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
                    $studies = Study::whereIn('course_id', $idCourses)->get();
                    foreach($studies as $study) {
                        $study->lessons()->detach();
                        $study->delete();
                    }
                    Lesson::whereIn('course_id',  $idCourses)->delete();
                    Course::whereIn('category_id', $idCategories)->delete();
                    $category->courses()->delete();
                    $category->categories()->delete();
                    $category->delete();
                }
            });

            Session::flash('success', trans('lang.delSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorDel'));
        }
    }

    public function searchCategory(Request $request)
    {
        try {
            if ($request->search) {
                $categories = Category::where('name', 'LIKE', '%' . $request->search . '%')->limit(config('setting.paginate'))->get();
            } else {
                $categories = Category::limit(config('setting.paginate'))->get();
            }

            return view('admin.category.search', compact('categories'));
        } catch (Exception $e) {
            $error['error'] = trans('lang.not_found');

            return response()->json($error);
        }
    }

    public function searchWordlist(Request $request)
    {
        try {
            if ($request->search) {
                $wordlists = WordList::where('name', 'LIKE', '%' . $request->search . '%')->limit(config('setting.paginate'))->get();
            } else {
                $wordlists = WordList::limit(config('setting.paginate'))->get();
            }

            return view('admin.wordlist.search', compact('wordlists'));
        } catch (Exception $e) {
            $error['error'] = trans('lang.not_found');

            return response()->json($error);
        }
    }
}
