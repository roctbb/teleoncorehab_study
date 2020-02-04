<?php

namespace App\Http\Controllers;

use App\CompletedCourse;
use App\Course;
use App\CourseStep;
use App\Http\Controllers\Controller;
use App\User;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Project;
use Illuminate\Support\Facades\Storage;
use Response;



class RequestsController extends Controller
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
        $pending = User::orderBy('name')->where('role', 'student')->where('state', 'pending')->get();
        $accepted = User::orderBy('name')->where('role', 'student')->where('state', 'accepted')->get();
        $declined = User::orderBy('name')->where('role', 'student')->where('state', 'declined')->get();
        return view('requests.index', compact('pending', 'accepted', 'declined'));
    }
    public function details($id = null)
    {
        $user = User::findOrFail($id);
        return view('requests.details', compact('user', 'guest'));
    }

    public function editView($id)
    {
        $guest  = User::findOrFail(Auth::User()->id);
        $user = User::findOrFail($id);
        $projects = $user->projects ();
        return view('requests.edit', compact('user', 'guest', 'projects'));
    }
    public function deleteCourse($id)
    {
        $course = CompletedCourse::findOrFail($id);
        $course->delete();
        return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'name' => 'required|string',
            'gender' => 'required|in:male,female',
            'birthday' => 'required|date|date_format:Y-m-d',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:512',
            'phone' => 'required|string|max:100',
            'university_name' => 'required|string|max:512',
            'university_diploma' => 'required|string|max:100',
            'university_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'internship_name' => 'required|string|max:512',
            'internship_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'postgraduate_name' => 'required|string|max:512',
            'postgraduate_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'courses_history' => 'nullable|string|max:2048',
            'certificate_number' => 'required|string|max:100',
            'certificate_specialty' => 'required|string|max:100',
            'certificate_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'job_title' => 'required|string|max:100',
            'job_place' => 'required|string|max:2048',
            'job_years' => 'required|numeric|min:0',
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->gender = $request->gender;
        $user->birthday = Carbon::createFromFormat('Y-m-d', $request->birthday);

        $user->country = $request->country;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->university_name = $request->university_name;
        $user->university_diploma = $request->university_diploma;
        $user->university_year = $request->university_year;
        $user->internship_name = $request->internship_name;
        $user->internship_year = $request->internship_year;
        $user->postgraduate_name = $request->postgraduate_name;
        $user->postgraduate_year = $request->postgraduate_year;
        $user->courses_history = $request->courses_history;
        $user->certificate_number = $request->certificate_number;
        $user->certificate_year = $request->certificate_year;
        $user->certificate_specialty = $request->certificate_specialty;
        $user->job_title = $request->job_title;
        $user->job_place = $request->job_place;
        $user->job_years = $request->job_years;
        $user->comments = $request->comments;


        if ($request->password!="") {
            $this->validate($request, ['password' => 'required|string|min:6|confirmed']);
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('image'))
        {
            $extn = '.'.$request->file('image')->guessClientExtension();
            $path = $request->file('image')->storeAs('user_avatars', $user->id.$extn);
            $user->image = $path;
        }

        $user->save();

        return redirect('/insider/profile/'.$id);
    }

    public function accept($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->state = 'accepted';
        $user->save();

        return redirect('/insider/requests');

    }

    public function decline($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->state = 'declined';
        $user->save();

        return redirect('/insider/requests');

    }

    public function download($user_id, $name)
    {
        $name = 'documents/'.$user_id.'/'.$name;

        if (!Storage::exists($name)) {
            return Response::make('File no found.', 404);
        }

        $file = Storage::get($name);
        $type = Storage::mimeType($name);
        $response = Response::make($file, 200)->header("Content-Type", $type);

        return $response;
    }

}
