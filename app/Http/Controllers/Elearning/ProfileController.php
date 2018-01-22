<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\ProcessFiles;
use App\Models\User;
use App\Models\Follow;
use App\Models\Study;
use App\Models\Course;
use Exception;
use Hash;
use Session;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\EditPasswordRequest;
use DB;

class ProfileController extends Controller
{
    use ProcessFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$user = Auth::user()) {
                throw new Exception();
            }
            $followings = $user->follows()->get();
            $followers = Follow::where('user_follow_id', $user->id)->get();
            $studies = Study::where('user_id', $user->id)->get();
            $courses = Course::limit(config('setting.number_course'))->orderBy('rank')->get();

            return view('elearning.profile.index', compact('user', 'followings', 'followers', 'courses', 'studies'));
        } catch (Exception $e) {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        try {
            $user = User::findOrFail($id);
            $followings = $user->follows()->get();
            $followers = Follow::where('user_follow_id', $user->id)->get();
            $studies = Study::where('user_id', $user->id)->get();
            $courses = Course::limit(config('setting.number_course'))->orderBy('rank')->get();
            
            return view('elearning.profile.index', compact('user', 'followings', 'followers', 'courses', 'studies'));
        } catch (Exception $e) {
            return redirect()->route('home');
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
        try {
            if (!$user = Auth::user()) {
                throw new Exception();
            }
            $courses = Course::limit(config('setting.number_course'))->orderBy('rank')->get();

            return view('elearning.profile.edit', compact('courses', 'user'));
        } catch (Exception $e) {
            return redirect()->route('login');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        try {
            $user = Auth::user();
            $data = $request->only(['name']);
            if ($request->newpassword) {
                $data['password'] = $request->newpassword;
            }
            $data['avatar'] = $this->storePicture($request, config('setting.avatar'), $user->avatar);
            $data['background'] = $this->storePicture($request, config('setting.background'), $user->background);
            $user->update($data);
            Session::flash('success', trans('lang.editSuccess'));

            return redirect()->route('elearning.profile.index');
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorEdit'));

            return redirect()->back();
        }
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

    public function updatePassword(EditPasswordRequest $request)
    {
        try {
            $user = Auth::user();
            if (!Hash::check($request->confirmpassword, $user->password)) {
                Session::flash('confirmwrong', trans('lang.confirmpassword_wrong'));
                throw new Exception();
            }
            $data['password'] = $request->newpassword;
            $user->update($data);
            Session::flash('success', trans('lang.editSuccess'));

            return redirect()->route('elearning.profile.index');
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorEdit'));

            return redirect()->back();
        }
    }

    public function addFollow(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $data = [
                'user_id' => $user->id,
                'user_follow_id' => $id,
                'status' => config('setting.status_default')
            ];
            Follow::create($data);
            Session::flash('success', trans('lang.followSuccess'));

            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.followFail'));

            return redirect()->back();
        }
    }

    public function unFollow(Request $request, $id)
    {
        try {
            $user = Auth::user();
            Follow::where('user_id', $user->id)->where('user_follow_id', $id)->delete();
            Session::flash('success', trans('lang.unfollowSuccess'));

            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.unfollowFail'));

            return redirect()->back();
        }
    }
}
