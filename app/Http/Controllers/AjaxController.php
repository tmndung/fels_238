<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Exception;

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
}
