<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Exception;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;

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
            }
        } catch (Exception $e) {
            $messages['error'] = trans('lang.error');
        }

        return response()->json($messages);
    }
}
