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
use Session;

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
        if (Category::whereIn('id', $request->idCategories)->delete()) {
            Session::flash('success', trans('lang.delSuccess'));
        } else {
            Session::flash('messages', trans('lang.errorDel'));
        }
    }
}
