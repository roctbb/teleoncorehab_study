<?php

namespace App\Http\Controllers;

use App\CompletedCourse;
use App\Course;
use App\CourseStep;
use App\Http\Controllers\Controller;
use App\QuestionAnswer;
use App\User;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Project;
use Illuminate\Support\Facades\Storage;
use Response;



class CertificatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pending = CompletedCourse::where('is_delivered', false)->where('mark', '>=', 70)->get();
        $delivered = CompletedCourse::where('is_delivered', true)->where('mark', '>=', 70)->get();
        $denied = CompletedCourse::where('is_delivered', false)->where('mark', '<', 70)->get();
        return view('certificates.index', compact('pending', 'delivered', 'denied'));
    }

    public function deliver($id, Request $request)
    {
        $user = CompletedCourse::findOrFail($id);
        $user->is_delivered = true;
        $user->save();

        return redirect('/insider/certificates');

    }
    public function delete($id, Request $request)
    {
        $completed = CompletedCourse::findOrFail($id);
        $user = $completed->user;
        $course = $completed->course;
        $completed->delete();

        QuestionAnswer::where('user_id', $user->id)->whereIn('question_id', $course->questions->pluck('id'))->delete();

        return redirect('/insider/certificates');

    }

}
