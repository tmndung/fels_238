<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\AddUserRequest;
use App\Traits\ProcessFiles;
use Exception;

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

            Session::flash('messages', trans('lang.addSuccess'));
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
            $data = $request->only(['name', 'email', 'description', 'facebook', 'twitter']);
            $data['password'] = $user->password;

            if ($request->has('password')) {
                $data['password'] = $request->password;
            }

            $data['avatar'] = $this->storePicture($request, config('setting.avatar'), $user->avatar);
            $data['background'] = $this->storePicture($request, config('setting.background'), $user->background);
            
            $user->update($data);

            Session::flash('messages', trans('lang.editSuccess'));         
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
            $user->delete();
            Session::flash('messages', trans('lang.delSuccess'));
        } catch (Exception $e) {
            Session::flash('messages', trans('lang.errorDel'));
        }

        return redirect()->route('admin.users.index');
    }
}
