<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\WordList;
use Illuminate\Support\Facades\Auth;
use Exception;
use DB;

trait ElearningProcessDatabase
{
    public function getCategoriesParent(Course $course)
    {
        $category = $course->category;
        $categoriesParent = [$category];
        while ($category->parent_id != config('setting.default_parent_id')) {
            $category = $category->category;
            array_unshift($categoriesParent, $category);
        }

        return $categoriesParent;
    }

    public function processUserLogin (Course $course, $data) 
    {
        if (Auth::check()) {
            // get study of user
            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
            // if user registered this course
            if (count($studyOfUser)) {
                $data['isActiveCourse'] = true;
                // get id all lesson user learned
                $data['idLessonsLearned'] = $studyOfUser->lessons()->where('is_learned', true)->pluck('lesson_id')->all();
                // get id all word user learned
                $data['idWordListsLearned'] = WordList::wordlistOfLesson($data['idLessonsLearned'])->pluck('id')->all();
                //get id all lesson user finished
                $data['idLessonsFinished'] = $studyOfUser->lessons()->where('is_finish', true)->pluck('lesson_id')->all();
                // get total word & word learned
                $idLessons = $course->lessons->pluck('id')->all();
                $data['totalWord'] = count(WordList::wordlistOfLesson($idLessons)->get());
                $data['learnedWord'] = count($data['idWordListsLearned']);
                // calculate progress percent
                $data['progressVal'] = config('setting.progressValDefault');
                if ($data['totalWord']) {
                    $data['progressVal'] = round(($data['learnedWord'] / $data['totalWord']) * config('setting.percent'));
                }

                // get my rank and my score
                $data['myRank'] = count($course->studies()->where('score', '>=', $studyOfUser->score)->get());
                $data['myScore'] = $studyOfUser->score;

                if (count($data['idLessonsFinished']) < count($course->lessons)) {
                    $data = $this->getLessonLearnedRecentOrCreate($data, $studyOfUser, $data['idLessonsFinished']);
                }
            }
        }

        return $data;
    }

    public function getLessonLearnedRecentOrCreate($data, $studyOfUser, $idLessonsFinished)
    {
        if (count($studyOfUser->lessons)) {
            // get lesson has learned recently
            $data['lesson'] = $studyOfUser->lessons()->orderBy('id', 'desc')->first();
            // if this lesson has finished then register new lesson
            if (in_array($data['lesson']->id, $idLessonsFinished)) {
                $data['lesson'] = $data['course']->lessons()->where('id', '>', $data['lesson']->id)->orderBy('id')->first();
                $studyOfUser->lessons()->attach($data['lesson']->id, [
                    'is_learned' => false,
                    'is_finish' => false,
                ]);
            }
        } else {
            $data['lesson'] = $data['course']->lessons()->orderBy('id')->first();
            $studyOfUser->lessons()->attach($data['lesson']->id, [
                'is_learned' => false,
                'is_finish' => false,
            ]);
        }
        
        return $data;
    }

    public function processLesson($data, $studyOfUser, $idLessonsFinished) 
    {
        $data['numOfLesson'] = count($data['course']->lessons()->where('id', '<=', $data['lesson']->id)->get()); 

        $isLearned = $studyOfUser->lessons()->where('lesson_id', $data['lesson']->id)->first()->pivot->is_learned;
        $isFinished = $studyOfUser->lessons()->where('lesson_id', $data['lesson']->id)->first()->pivot->is_finish;

        if ($isLearned && $isFinished) {
            $data['roleShowBtn'] = config('setting.finishedLesson');
        } elseif ($isLearned && !$isFinished) {
            $data['roleShowBtn'] = config('setting.learnedButNotFinished');
        } elseif (!$isLearned && !$isFinished) {
            $data['roleShowBtn'] = config('setting.notFinished');
        } else {
            throw new Exception();
        }

        $data['preLesson'] = $data['course']->lessons()->where('id', '<', $data['lesson']->id)->orderBy('id', 'desc')->first();
        $data['nextLesson'] = $data['course']->lessons()->where('id', '>', $data['lesson']->id)->orderBy('id')->first();
        
        if (!count($data['preLesson'])) {
            $data['preLesson'] = config('setting.dontHaveLessonVal');
        }
        
        if (!count($data['nextLesson']) || !in_array($data['lesson']->id, $idLessonsFinished)) {
            $data['nextLesson'] = config('setting.dontHaveLessonVal');
        }

        return $data;
    }

    public function checkLessonCurrent(Course $course, Lesson $lesson) 
    {
        try {
            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
            // get all lesson which user has been registered learn
            $idLessonsLearn = $studyOfUser->lessons()->pluck('lesson_id')->all();
            // get all lesson of course
            $idLessons = $course->lessons()->pluck('id')->all();
            
            if (!in_array($lesson->id, $idLessons) || !in_array($lesson->id, $idLessonsLearn)) {
                throw new Exception();
            }

            // if user has been learned this lesson, rediect to lesson-detail
            $isLearned = $studyOfUser->lessons()->where('lesson_id', $lesson->id)->first()->pivot->is_learned;
            if ($isLearned) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function checkPassTest(Course $course, Lesson $lesson) 
    {
        try {
            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
            $isFinish = $studyOfUser->lessons()->where('lesson_id', $lesson->id)->first()->pivot->is_finish;
            if ($isFinish) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function updateStudyLesson(Course $course, Lesson $lesson)
    {
        try {
            $pointBonusLearned = $lesson->point * config('setting.ratioPointLearned');
            DB::transaction(function () use ($course, $lesson, $pointBonusLearned) {
                $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->first();
                $studyOfUser->lessons()->updateExistingPivot($lesson->id ,[
                    'is_learned' => true,
                ]);
                $studyOfUser->update([
                    'score' => $studyOfUser->score + $pointBonusLearned,
                ]);
            });

            $totalWord = count($lesson->wordLists);
            $routeRedirect = route('elearning.courses.lesson.show', [$course->id, $lesson->id]);
            $msgPointBonus = trans('lang.bonus') . ': +' . $pointBonusLearned;

            return view('templates.ajax.endlearning', compact([
                'course',
                'lesson',
                'totalWord',
                'routeRedirect',
                'msgPointBonus',
            ]));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function updateRankOfCourses()
    {
        $rankCourses = Course::withCount('studies')->orderBy('studies_count', 'desc')->get();

        foreach ($rankCourses as $rank => $course) {
            $course->update([
                'rank' => $rank + 1,
            ]);
        }
    }
} 
