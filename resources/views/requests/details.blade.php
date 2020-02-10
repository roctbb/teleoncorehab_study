@extends('layouts.app')

@section('content')
    <h3>{{$user->name}}</h3>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <!--
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


                    -->
                    <table class="table table-striped" valign="center">
                        <tr>
                            <td>Статус заявки: <strong>@if ($user->state == 'accepted')
                                        утверждена @elseif ($user->state == 'pending') на рассмотрении @else
                                        отклонена @endif</strong></td>
                            <td style="text-align: right">
                                <a href="{{ url('insider/profile/'.$user->id.'/accept') }}"
                                   class="btn btn-success btn-sm"
                                   onclick="return confirm('Вы уверены, что хотите утвердить заявку?')">Утвердить</a>
                                <a href="{{ url('insider/profile/'.$user->id.'/decline') }}"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Вы уверены, что хотите отклонить заявку?')">Отклонить</a>
                                <a class="btn btn-primary btn-sm"
                                   href="{{'/insider/profile/'.$user->id.'/edit'}}"><i
                                            class="icon ion-android-create"></i>
                                    Редактировать</a>
                            </td>
                        </tr>

                        <tr>
                            <th colspan="2">Аккаунт</th>
                        </tr>

                        <tr>
                            <td>Email:</td>
                            <td style="text-align: right">{{$user->email}}</td>
                        <tr>
                            <td>Комментарий:</td>
                            <td style="text-align: right">{{$user->comments}}</td>
                        </tr>

                        <tr>
                            <th colspan="2">Персональная информация</th>
                        </tr>

                        <tr>
                            <td>Дата рождения:</td>
                            <td style="text-align: right">{{$user->birthday->format('d.m.Y')}}</td>
                        <tr>
                            <td>Гражданство:</td>
                            <td style="text-align: right">{{$user->country}}</td>
                        </tr>

                        <tr>
                            <td>Адрес постоянного места жительства:</td>
                            <td style="text-align: right">{{$user->address}}</td>
                        </tr>

                        <tr>
                            <td>Телефон:</td>
                            <td style="text-align: right">{{$user->phone}}</td>
                        </tr>

                        <tr>
                            <th colspan="2">Образование</th>
                        </tr>

                        <tr>
                            <td>Высшее учебное заведение:</td>
                            <td style="text-align: right">{{$user->university_name}}
                                <i>(диплом {{$user->university_diploma}}
                                    , {{$user->university_year}} год)</i></td>
                        </tr>

                        <tr>
                            <td>Специальность интернатуры:</td>
                            <td style="text-align: right">{{$user->internship_name}}
                                <i>({{$user->internship_year}} год)</i></td>
                        </tr>

                        <tr>
                            <td>Специальность интернатуры:</td>
                            <td style="text-align: right">{{$user->internship_name}}
                                <i>({{$user->internship_year}} год)</i></td>
                        </tr>

                        <tr>
                            <td>Специальность ординатуры:</td>
                            <td style="text-align: right">{{$user->postgraduate_name}}
                                <i>({{$user->postgraduate_year}} год)</i></td>
                        </tr>

                        <tr>
                            <td>Повышение квалификации:</td>
                            <td style="text-align: right">{{$user->courses_history}}</td>
                        </tr>

                        <tr>
                            <td>Сертификат специалиста:</td>
                            <td style="text-align: right">{{$user->certificate_specialty}}
                                <i>(номер {{$user->certificate_number}}, {{$user->certificate_year}} год)</i></td>
                        </tr>

                        <tr>
                            <th colspan="2">Карьера</th>
                        </tr>

                        <tr>
                            <td>Текущее место работы:</td>
                            <td style="text-align: right">{{$user->job_place}}</td>
                        </tr>

                        <tr>
                            <td>Должность:</td>
                            <td style="text-align: right">{{$user->job_place}}</td>
                        </tr>

                        <tr>
                            <td>Стаж по специальности:</td>
                            <td style="text-align: right">{{$user->job_years}}</td>
                        </tr>

                        <tr>
                            <th colspan="2">Документы</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <ul>
                                    <li><a target="_blank"
                                           href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->diploma_file) }}">Диплом</a>
                                    </li>
                                    @if ($user->surname_file != null)
                                        <li><a target="_blank"
                                               href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->surname_file) }}">Документ
                                                о смене фамилии</a></li>
                                    @endif
                                    <li><a target="_blank"
                                           href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->postgraduate_file) }}">Документ
                                            об окончании ординатуры</a></li>
                                    <li><a target="_blank"
                                           href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->certificate_file) }}">Сертификат</a>
                                    </li>
                                    <li><a target="_blank"
                                           href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->snils_file) }}">СНИЛС</a>
                                    </li>
                                    <li><a target="_blank"
                                           href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->passport_file) }}">Паспорт</a>
                                    </li>
                                    <li><a target="_blank"
                                           href="{{ url('/insider/profile/'.$user->id.'/download/'.$user->request_file) }}">Заявление</a>
                                    </li>
                                </ul>


                            </td>
                        </tr>


                    </table>


                </div>
            </div>

            @if($user->courses()->where('state', 'started')->count()!=0)
                <h4 style="margin: 20px;" class="card-title"> Текущие курсы </h4>
                <div class="row">
                    @foreach($user->courses as $course)
                        @if ($course->state == 'started')
                            <div class="col-md-6">
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$course->name}}</h5>

                                        <a href="{{url('insider/courses/'.$course->id)}}" class="card-link">Страница
                                            курса</a>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            @if($user->completedCourses->count()!=0)
                <div class="row">
                    <div class="col-md-8">
                        <h4 style="margin: 20px;" class="card-title">Завершенные курсы</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($user->completedCourses as $course)
                        <div class="col-md-6">
                            <div class="card" style="width: 100%; margin-bottom: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title">{{$course->name}}
                                        <a onclick="return confirm('Вы уверены что хотите аннулировать тест? ')" class="float-right"
                                           href="{{url('/insider/certificates/'.$course->id.'/delete')}}"><span
                                                    aria-hidden="true">&times;</span></a></h5>
                                    <p>
                                        <span class="badge badge-pill badge-success">Оценка: <strong>{{$course->mark}}</strong></span>

                                        <br>
                                        <br>

                                        <a href="{{url('insider/courses/'.$course->course_id)}}"
                                           class="btn btn-sm btn-primary">Страница
                                            курса</a>

                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


        </div>
    </div>


@endsection
