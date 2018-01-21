<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Session;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\AddUserRequest;
use App\Traits\ProcessFiles;
use Exception;
use DB;

class UsersController extends Controller
{
    use ProcessFiles;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(config('setting.paginate'));

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        try {
            $data = $request->only(['name', 'password', 'email']);
            User::create($data);

            Session::flash('success', trans('lang.addSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorAdd'));
        }

        return redirect()->route('admin.users.index');
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
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $user)
    {
        try {
            $data = $request->only(['name', 'email', 'description']);
            $data['password'] = $user->password;

            if ($request->has('password')) {
                $data['password'] = $request->password;
            }

            $data['avatar'] = $this->storePicture($request, config('setting.avatar'), $user->avatar);
            $data['background'] = $this->storePicture($request, config('setting.background'), $user->background);
            
            $user->update($data);

            Session::flash('success', trans('lang.editSuccess'));         
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorEdit'));
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                foreach($user->studies as $study) {
                    $study->lessons()->detach();
                    $study->delete();
                }
                $user->follows()->delete();
                Follow::where('user_follow_id', $user->id)->delete();
                $user->delete();
            });
            
            Session::flash('success', trans('lang.delSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorDel'));
        }

        return redirect()->route('admin.users.index');
    }

    public function adminActive(Request $request)
    {
        try {
            $data = $request->only('is_admin', 'user_id');
            $user = User::findOrFail($data['user_id']);
            $user->update([
                'is_admin' => (bool) $data['is_admin'],
            ]);
        } catch (Exception $e) {
            return redirect('admin.404');
        }
    }

    public function deleteAll(Request $request)
    {
        $idUsers = $request->idUsers;
        try {
            DB::transaction(function () use ($idUsers) {
                $users = User::whereIn('id', $idUsers)->get();
                foreach ($users as $user) {
                    foreach($user->studies as $study) {
                        $study->lessons()->detach();
                        $study->delete();
                    }
                    $user->follows()->delete();
                    Follow::where('user_follow_id', $user->id)->delete();
                    $user->delete();
                }
            });

            Session::flash('success', trans('lang.delSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorDel'));
        }
    }

    public function searchUser(Request $request)
    {
        $searchVal = '%' . $request->searchVal . '%';
        $users = User::where('name', 'like', $searchVal)->orWhere('email', 'like', $searchVal)->paginate(config('setting.paginate'));

        return view('admin.users.search', compact('users'));
    }
}
