<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function CourseDetails($id, $slug){
        $course = Course::find($id);
        $goals = Course_goal::where('course_id', $id)->orderBy('id','DESC')->get();

        $instructor_id = $course->instructor_id;
        $instructor_course = Course::where('instructor_id',$instructor_id)->orderBy('id','DESC')->limit(5)->get();

        $categories = Category::latest()->get();

        $cat_id = $course->category_id;
        $relatedCourses = Course::where('category_id',$cat_id )->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.course.course_details', compact('course', 'goals', 'instructor_course', 'categories', 'relatedCourses'));
    }

    public function CategoryCourse($id, $slug){

        $courses = Course::where('category_id',$id)->where('status','1')->get();
        $category = Category::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.category_all',compact('courses','category','categories'));
    }// End Method

    public function SubCategoryCourse($id, $slug){

        $courses = Course::where('subcategory_id',$id)->where('status','1')->get();
        $subcategory = SubCategory::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.subcategory_all',compact('courses','subcategory','categories'));
    }// End Method

    public function InstructorDetails($id){

        $instructor = User::find($id);
        $courses = Course::where('instructor_id',$id)->get();
        return view('frontend.instructor.instructor_details',compact('instructor','courses'));

    }// End Method
}
