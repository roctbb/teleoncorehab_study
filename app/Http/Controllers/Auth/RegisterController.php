<?php

namespace App\Http\Controllers\Auth;

use App\Provider;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use App\Course;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'insider/courses';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string',
            'gender' => 'required|in:male,female',
            'birthday' => 'required|date|date_format:Y-m-d',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:512',
            'phone' => 'required|string|max:100',
            'university_name' => 'required|string|max:512',
            'university_diploma' => 'required|string|max:100',
            'university_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'internship_name' => 'nullable|string|max:512',
            'internship_year' => 'nullable|numeric|min:1930|max:'.Carbon::now()->year,
            'postgraduate_name' => 'nullable|string|max:512',
            'postgraduate_year' => 'nullable|numeric|min:1930|max:'.Carbon::now()->year,
            'courses_history' => 'nullable|string|max:2048',
            'certificate_number' => 'nullable|string|max:100',
            'certificate_specialty' => 'nullable|string|max:100',
            'certificate_year' => 'nullable|numeric|min:1930|max:'.Carbon::now()->year,
            'job_title' => 'required|string|max:100',
            'job_place' => 'required|string|max:2048',
            'job_years' => 'required|numeric|min:0',
            'diploma_file' => 'required|file|max:15000',
            'surname_file' => 'nullable|file|max:15000',
            'postgraduate_file' => 'nullable|file|max:15000',
            'certificate_file' => 'required|file|max:15000',
            'snils_file' => 'required|file|max:15000',
            'passport_file' => 'required|file|max:15000',
            'request_file' => 'required|file|max:15000'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create($data)
    {


        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->gender = $data->gender;
        $user->birthday = Carbon::createFromFormat('Y-m-d', $data->birthday);

        $user->country = $data->country;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->university_name = $data->university_name;
        $user->university_diploma = $data->university_diploma;
        $user->university_year = $data->university_year;
        $user->internship_name = $data->internship_name;
        $user->internship_year = $data->internship_year;
        $user->postgraduate_name = $data->postgraduate_name;
        $user->postgraduate_year = $data->postgraduate_year;
        $user->courses_history = $data->courses_history;
        $user->certificate_number = $data->certificate_number;
        $user->certificate_year = $data->certificate_year;
        $user->certificate_specialty = $data->certificate_specialty;
        $user->job_title = $data->job_title;
        $user->job_place = $data->job_place;
        $user->job_years = $data->job_years;
        $user->state = 'activated';

        $user->save();

        # diploma
        $fileName = "diploma".time().'.'.$data->diploma_file->getClientOriginalExtension();
        $path = $data->diploma_file->storeAs('documents/'.$user->id.'/', $fileName);
        $user->diploma_file = $fileName;

        # surname
        if ($data->hasFile('surname_file'))
        {
            $fileName = "surname".time().'.'.$data->surname_file->getClientOriginalExtension();
            $path = $data->surname_file->storeAs('documents/'.$user->id.'/', $fileName);
            $user->surname_file = $fileName;
        }

        # postgraduate_file
        if ($data->hasFile('postgraduate_file'))
        {
            $fileName = "postgraduate".time().'.'.$data->postgraduate_file->getClientOriginalExtension();
            $path = $data->postgraduate_file->storeAs('documents/'.$user->id.'/', $fileName);
            $user->postgraduate_file = $fileName;
        }


        # certificate_file
        if ($data->hasFile('certificate_file'))
        {
            $fileName = "certificate".time().'.'.$data->certificate_file->getClientOriginalExtension();
            $path = $data->certificate_file->storeAs('documents/'.$user->id.'/', $fileName);
            $user->certificate_file = $fileName;
        }

        # snils_file
        $fileName = "snils".time().'.'.$data->snils_file->getClientOriginalExtension();
        $path = $data->snils_file->storeAs('documents/'.$user->id.'/', $fileName);
        $user->snils_file = $fileName;

        # snils_file
        $fileName = "passport".time().'.'.$data->passport_file->getClientOriginalExtension();
        $path = $data->passport_file->storeAs('documents/'.$user->id.'/', $fileName);
        $user->passport_file = $fileName;

        # request_file
        $fileName = "request".time().'.'.$data->request_file->getClientOriginalExtension();
        $path = $data->request_file->storeAs('documents/'.$user->id.'/', $fileName);
        $user->request_file = $fileName;

        $user->save();
        return $user;
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request)));
        $this->guard()->login($user);

        //$when = \Carbon\Carbon::now()->addSeconds(1);
        //Notification::send(User::where('role', 'teacher')->get(), (new \App\Notifications\NewRequests($user))->delay($when));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
