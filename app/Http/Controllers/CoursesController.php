<?php

namespace App\Http\Controllers;

use App\CompletedCourse;
use App\Course;
use App\CourseStep;
use App\Http\Controllers\Controller;
use App\Provider;
use App\User;
use App\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class CoursesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('course')->only(['details']);
        $this->middleware('teacher')->only(['createView', 'editView', 'start', 'stop', 'edit', 'create', 'assesments']);
    }


    public function pending()
    {
        $user = Auth::User();
        if ($user->state == 'accepted')
            return redirect('/');
        return view('pending');
    }

    public function declined()
    {
        $user = Auth::User();
        if ($user->state == 'accepted')
            return redirect('/');
        return view('declined');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::User()->id);
        $courses = Course::orderBy('id')->get();
        return view('home', compact('courses', 'user'));
    }

    public function details($id)
    {
        $user = User::findOrFail(Auth::User()->id);
        \App\ActionLog::record(Auth::User()->id, 'course', $id);
        $course = Course::findOrFail($id);
        $completed = CompletedCourse::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();

        return view('courses.details', compact('course', 'user', 'completed'));
    }

    public function assessments($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.assessments', compact('course'));
    }

    public function createView()
    {
        return view('courses.create');
    }

    public function editView($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function start($id)
    {
        $course = Course::findOrFail($id);
        $course->start();
        return redirect('/insider/courses/' . $course->id);
    }

    public function stop($id)
    {
        $course = Course::findOrFail($id);
        $course->end();
        return redirect('/insider/courses/' . $course->id);
    }

    public function edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->git = $request->git;
        $course->site = $request->site;
        $course->image = $request->image;
        $course->telegram = $request->telegram;
        /*if ($request->hasFile('image')) {
            $extn = '.' . $request->file('image')->guessClientExtension();
            $path = $request->file('image')->storeAs('course_avatars', $course->id . $extn);
            $course->image = $path;

        }*/
        if ($request->hasFile('import'))
        {
            $json = file_get_contents($request->file('import')->getRealPath());

            $course->import($json);
        }

        $course->save();
        return redirect('/insider/courses/' . $course->id);
    }

    public function create(Request $request)
    {
        $user = User::findOrFail(Auth::User()->id);
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|max:1000'
        ]);
        $course = Course::createCourse($request);
        if ($request->hasFile('image')) {
            $extn = '.' . $request->file('image')->guessClientExtension();
            $path = $request->file('image')->storeAs('course_avatars', $course->id . $extn);
            $course->image = $path;

        } else {
            $course->image = 'course_avatars/blank.png';
        }
        $course->provider_id = $user->provider_id;
        $course->save();
        return redirect('/insider/courses');
    }

    public function enroll(Request $request)
    {

        $course = Course::findOrFail($request->id);
        $user = \Auth::User();

        if ($course->students->contains($user)) {
            $this->make_error_alert('Ошибка!', 'Вы уже зачислены на курс "' . $course->name . '".');
            return $this->backException();
        }

        if ($course->state != 'started') {
            $this->make_error_alert('Ошибка!', 'Курс "' . $course->name . '" еще не начался или уже окончен.');
            return $this->backException();
        }

        $this->make_success_alert('Успех!', 'Вы присоединились к курсу "' . $course->name . '".');
        $course->students()->attach([$user->id => ['is_remote' => false]]);


        return redirect()->back();
    }

    public function export($id)
    {
        $course = Course::findOrFail($id);

        $json = $course->export();

        $response = \Response::make($json);
        $response->header('Content-Type', 'application/json');
        $response->header('Content-length', strlen($json));
        $response->header('Content-Disposition', 'attachment; filename=course-' . $id.'.json');

        return $response;

    }
}
