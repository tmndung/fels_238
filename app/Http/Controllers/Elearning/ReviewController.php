<?php

namespace App\Http\Controllers\Elearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\WordList;
use App\Traits\ElearningProcessDatabase;
use Illuminate\Support\Facades\Auth;
use Session;
use Exception;

class ReviewController extends Controller
{
    use ElearningProcessDatabase;

    public function reviewWordLesson(Course $course, Lesson $lesson)
    {
        try {
            if (!$this->checkLessonCurrent($course, $lesson)) {
                throw new Exception();
            }

            if (Session::has('wordReview')) {
                Session::forget('wordReview'); 
            }

            $idWordlist = $lesson->wordLists()->pluck('id')->random();
            $word = $lesson->wordLists()->where('id', $idWordlist)->first();

            $wordReview = [];
            array_push($wordReview, $idWordlist);
            Session::put('wordReview', $wordReview);

            $numberOfWordReview = (count($lesson->wordLists) < config('setting.numberOfWordReview')) ? count($lesson->wordLists) : config('setting.numberOfWordReview');
            
            $offsetProgress = round((1 / $numberOfWordReview) * config('setting.percent'));
            Session::put('numberOfWordReview', $numberOfWordReview);
            $progressVal = config('setting.progressValDefault');
            $roleAjax = config('setting.ajaxReviewWordLesson');

            return view('elearning.review', compact([
                'word',
                'lesson',
                'progressVal',
                'offsetProgress',
                'course',
                'roleAjax',
            ]));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function reviewWordCourse(Course $course)
    {
        try {
            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
            if (!count($studyOfUser)) {
                throw new Exception();
            }

            $idLessonLearned = $studyOfUser->lessons()->where('is_learned', true)->pluck('lesson_id');
            if (!count($idLessonLearned)) {
                throw new Exception();
            }

            if (Session::has('wordReview')) {
                Session::forget('wordReview'); 
            }

            $lesson = $course->lessons()->where('id', $idLessonLearned->random())->first();
            $idWordlist = $lesson->wordLists()->pluck('id')->random();
            $word = $lesson->wordLists()->where('id', $idWordlist)->first();

            $wordReview = [];
            array_push($wordReview, $idWordlist);
            Session::put('wordReview', $wordReview);

            $totalWordLearned = count(WordList::wordlistOfLesson($idLessonLearned->all())->get());
            $numberOfWordReview = ($totalWordLearned < config('setting.numberOfWordReview')) ? $totalWordLearned : config('setting.numberOfWordReview');
            
            $offsetProgress = round((1 / $numberOfWordReview) * config('setting.percent'));
            Session::put('numberOfWordReview', $numberOfWordReview);
            $progressVal = config('setting.progressValDefault');
            $roleAjax = config('setting.ajaxReviewWordCourse');

            return view('elearning.review', compact([
                'word',
                'lesson',
                'progressVal',
                'offsetProgress',
                'course',
                'roleAjax',
            ]));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function ajaxreviewWord(Request $request)
    {
        try {
            $dataRequest = $request->only([
                'lesson_id',
                'course_id',
                'offsetProgress',
                'progress',
                'role',
            ]);

            $roleAjax = $dataRequest['role'];
            $course = Course::findOrFail($dataRequest['course_id']);
            $lesson = Lesson::findOrFail($dataRequest['lesson_id']);

            if ($roleAjax == config('setting.ajaxReviewWordCourse')) {
                $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
                $idLessonLearned = $studyOfUser->lessons()->where('is_learned', true)->pluck('lesson_id')->all();
            }

            $offsetProgress = $dataRequest['offsetProgress'];
            $progressVal = $dataRequest['progress'] + $offsetProgress;
            $wordReview = [];

            if (Session::has('wordReview')) {
                $wordReview = Session::get('wordReview');
                if (count($wordReview) == Session::get('numberOfWordReview')) {
                    Session::forget('wordReview');
                    Session::forget('numberOfWordReview');
                    $totalWord = count($wordReview);
                    $msg = trans('lang.messageReviewed');

                    $routeRedirect = route('elearning.courses.lesson.show', [$course->id, $lesson->id]);
                    if ($roleAjax == config('setting.ajaxReviewWordCourse')) {
                        $routeRedirect = route('elearning.courses.show', [$course->id]);
                    }

                    return view('templates.ajax.endlearning', compact([
                        'course',
                        'lesson',
                        'totalWord',
                        'msg',
                        'routeRedirect',
                    ]));
                }   
            }

            do {
                $idWordlist = $lesson->wordLists()->pluck('id')->random();    
                if ($roleAjax == config('setting.ajaxReviewWordCourse')) {
                    $idWordlist = WordList::wordlistOfLesson($idLessonLearned)->pluck('id')->random();
                }
            } while (in_array($idWordlist, $wordReview));

            $word = WordList::findOrFail($idWordlist);
            array_push($wordReview, $idWordlist);
            Session::put('wordReview', $wordReview);

            return view('templates.ajax.reviewing', compact([
                'word',
                'lesson',
                'progressVal',
                'offsetProgress',
                'course',
                'roleAjax',
            ]));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
