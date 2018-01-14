<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\WordList;
use Illuminate\Support\Facades\Auth;

trait ElearningProcessDatabase
{
    public function getCategoriesParentName(Course $course)
    {
        $category = $course->category;
        $categoriesParentName = [$category->name];
        while ($category->parent_id != config('setting.default_parent_id')) {
            $category = $category->category;
            array_unshift($categoriesParentName, $category->name);
        }

        return $categoriesParentName;
    }

    public function processUserLogin (Course $course, $data) 
    {
        if (Auth::check()) {
            // get study of user
            $studyOfUser = $course->studies()->where('user_id', Auth::user()->id)->get();
            // if user registered this course
            if(count($studyOfUser)) {
                $data['isActiveCourse'] = true;
                // get id all lesson user learned
                $data['idLessonsLearned'] = $studyOfUser->first()->lessons()->where('is_finish', true)->pluck('lesson_id')->all();
                // get id all word user learned
                $data['idWordListsLearned'] = WordList::wordlistOfLesson($data['idLessonsLearned'])->pluck('id')->all();
                // get total word & word learned
                $data['totalWord'] = count($data['wordLists']);
                $data['learnedWord'] = count($data['idWordListsLearned']);
                // calculate progress percent
                $data['progressVal'] = config('setting.progressValDefault');
                if ($data['totalWord']) {
                    $data['progressVal'] = round(($data['learnedWord'] / $data['totalWord']) * config('setting.percent'));
                }
            }
        }

        return $data;
    }
} 
