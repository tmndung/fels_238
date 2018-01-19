<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Study;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('parent_id', config('setting.default_parent_id'))->limit(config('setting.top_category'))->get();
            $featuredCourses = Course::limit(config('setting.number_course'))->orderBy('rank')->get();
            foreach ($categories as $category) {
                $idSubCategories = $category->categories()->pluck('id');
                $courses = Course::whereIn('category_id', $idSubCategories)->limit(config('setting.number_course'))->inRandomOrder()->get();
                $randomCourses[$category->name] = $courses;
            }
            $allCourses = Course::inRandomOrder()->limit(config('setting.number_course'))->orderBy('created_at', 'DESC')->get();
            $count['category'] = Category::where('parent_id', '<>', config('setting.default_parent_id'))->count();
            $count['course'] = Course::count();
            $count['student'] = Study::count();
            $count['lesson'] = Lesson::count();
            
            return view('elearning.index', compact('categories', 'featuredCourses', 'allCourses', 'count', 'randomCourses'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }
}
