<?php

namespace App\Http\Controllers\Auth;

use App\Provider;
use App\User;
use App\Http\Controllers\Controller;
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
            'internship_name' => 'required|string|max:512',
            'internship_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'postgraduate_name' => 'required|string|max:512',
            'postgraduate_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'courses' => 'nullable|string|max:2048',
            'certificate_number' => 'required|string|max:100',
            'certificate_specialty' => 'required|string|max:100',
            'certificate_year' => 'required|numeric|min:1930|max:'.Carbon::now()->year,
            'job_title' => 'required|string|max:100',
            'job_place' => 'required|string|max:2048',
            'job_years' => 'required|numeric|min:0',
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
        $user->courses = $data->courses;
        $user->certificate_number = $data->certificate_number;
        $user->certificate_year = $data->certificate_year;
        $user->certificate_specialty = $data->certificate_specialty;
        $user->job_title = $data->job_title;
        $user->job_place = $data->job_place;
        $user->job_years = $data->job_years;
        $user->state = 'pending';


        /*if ($data->hasFile('image'))
        {
            $extn = '.'.$data->file('image')->guessClientExtension();
            $path = $data->file('image')->storeAs('user_avatars', $user->id.$extn);
            $user->image = $path;
        }*/

        $user->save();
        return $user;
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request)));
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
