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
        return view('elearning.index');
    }
}
