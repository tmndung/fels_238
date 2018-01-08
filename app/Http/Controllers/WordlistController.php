<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordList;
use App\Models\Lesson;
use App\Http\Requests\WordlistRequest;
use Exception;

class WordlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objWordLists = WordList::orderBy('created_at', 'DESC')->paginate(config('setting.paginate'));

        return view('admin.wordlist.index', compact('objWordLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = Lesson::pluck('name', 'id');

        return view('admin.wordlist.add', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordlistRequest $request)
    {
        try {
            $columns = $request->only('name', 'pronunciation', 'explain', 'lesson_id');
            WordList::create($columns);
            $message = trans('lang.addSuccess');
        } catch (Exception $e) {
            $message = trans('lang.errorAdd');
        }

        return redirect()->action('WordlistController@index')->with('messages', $message);
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
    public function edit(WordList $wordlist)
    {
        $lessons = Lesson::pluck('name', 'id');

        return view('admin.wordlist.edit', compact('wordlist', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordlistRequest $request, WordList $wordlist)
    {
        try {
            $columns = $request->only('name', 'pronunciation', 'explain', 'lesson_id');
            $wordlist->update($columns);
            $message = trans('lang.editSuccess');
        } catch (Exception $e) {
            $message = trans('lang.errorEdit');
        }

        return redirect()->action('WordlistController@index')->with('messages', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WordList $wordlist)
    {
        try {
            $wordlist->delete();
            $message = trans('lang.delSuccess');
        } catch (Exception $e) {
            $message = trans('lang.errorDel');
        }

        return redirect()->back()->with('messages', $message);
    }
}
