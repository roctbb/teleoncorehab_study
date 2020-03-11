@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY: "{{$course->name}}"
@endsection

@section('tabs')

@endsection



@section('content')
    <div class="row">
        <div class="col">
            <h2 style="font-weight: 300;"><a class="back-link" href="{{url('/insider/courses/')}}"><i
                            class="icon ion-chevron-left"></i></a>&nbsp;{{$course->name}}</h2>
            <p>{{$course->description}}</p>
        </div>
        @if ($user->role=='teacher')
            <div class="col">
                <div class="float-right">
                    <a href="{{url('/insider/courses/'.$course->id.'/create')}}" class="btn btn-primary btn-sm"><i
                                class="icon ion-compose"></i></a>
                    <a href="{{url('/insider/courses/'.$course->id.'/edit')}}"
                       class="btn btn-primary btn-sm"><i
                                class="icon ion-android-create"></i></a>
                    <a href="{{url('/insider/courses/'.$course->id.'/questions/editor')}}"
                       class="btn btn-primary btn-sm"><i
                                class="icon ion-ios-list"></i></a>
                    @if ($course->state=="draft")
                        <a href="{{url('/insider/courses/'.$course->id.'/start')}}"
                           class="btn btn-success btn-sm"><i
                                    class="icon ion-power"></i></a>
                    @elseif ($course->state=="started")
                        <a href="{{url('/insider/courses/'.$course->id.'/stop')}}"
                           class="btn btn-danger btn-sm"><i
                                    class="icon ion-stop"></i></a>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <div class="row">

        <div class="@if ($user->role=='teacher')col-md-8" @else col @endif">
        @if ($user->role!='teacher')
            @if ($completed)
                @if ($completed->mark >= 70)
                    <div class="alert alert-success" role="alert">
                        Вы успешно прошли итоговый тест! В ближайшее время мы свяжемся с вами по поводу получения свидетельства. Если у вас есть вопросы, свяжитесь с нами по
                        адресу {{ config('app.info_email') }}.

                        <br><br>
                        <a href="{{url('insider/courses/'.$course->id.'/questions/report')}}">Просмотр результатов.</a>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        Вы прошли итоговый тест, но, к сожалению, не набрали достаточное количество баллов для получения свидетельства. Если у вас есть вопросы, свяжитесь с нами по
                        адресу {{ config('app.info_email') }}.
                        <br><br>
                        <a href="{{url('insider/courses/'.$course->id.'/questions/report')}}">Просмотр результатов.</a>


                    </div>
                @endif
            @else
                <div class="alert alert-info" role="alert">
                    Для получения свидетельства по курсу вам необходимо изучить материалы ниже и набрать не менее 70% правильных ответов в итоговом тесте. Итоговый тест можно пройти только один раз.

                    <br><br>
                    <a href="{{url('insider/courses/'.$course->id.'/questions/')}}">Пройти итоговый тест.</a>
                </div>
            @endif
        @endif
        @foreach($lessons as $key => $lesson)
            @if ($lesson->steps->count()!=0)
                <div class="card-group">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5>{{$key+1}}. <a class="collection-item"
                                                       href="{{url('/insider/steps/'.$lesson->steps->first()->id)}}">{{$lesson->name}}</a>
                                    </h5>
                                </div>
                                @if ($user->role=='teacher')
                                    <div class="col-sm-auto">
                                        <a href="{{url('insider/lessons/'.$lesson->id.'/edit')}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="icon ion-android-create"></i></a>
                                        <a href="{{url('insider/lessons/'.$lesson->id.'/export')}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="icon ion-ios-cloud-download"></i></a>
                                        <a href="{{url('insider/lessons/'.$lesson->id.'/lower')}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="icon ion-arrow-up-c"></i></a>
                                        <a href="{{url('insider/lessons/'.$lesson->id.'/upper')}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="icon ion-arrow-down-c"></i></a>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col">
                                    @parsedown($lesson->description)
                                </div>

                            </div>


                        </div>
                        @if ($lesson->start_date!=null)
                            <div class="card-footer">
                                @if ($user->role=='teacher')
                                    <div class="collapse" id="marks{{$lesson->id}}">
                                        @foreach($students as $student)
                                            <div class="row">
                                                <div class="col">
                                                    {{$student->name}}
                                                </div>
                                                <div class="col">
                                                    <div class="progress" style="margin: 5px;">
                                                        @if ($lesson->percent($student) < 40)
                                                            <div class="progress-bar progress-bar-striped bg-danger"
                                                                 role="progressbar"
                                                                 style="width: {{$lesson->percent($student)}}%"
                                                                 aria-valuenow="{{$lesson->percent($student)}}"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100">{{$lesson->points($student)}}
                                                                / {{$lesson->max_points($student)}}</div>

                                                        @elseif($lesson->percent($student) < 60)
                                                            <div class="progress-bar progress-bar-striped bg-warning"
                                                                 role="progressbar"
                                                                 style="width: {{$lesson->percent($student)}}%"
                                                                 aria-valuenow="{{$lesson->percent($student)}}"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                Успеваемость: {{$lesson->points($student)}}
                                                                / {{$lesson->max_points($student)}}</div>

                                                        @else
                                                            <div class="progress-bar progress-bar-striped bg-success"
                                                                 role="progressbar"
                                                                 style="width: {{$lesson->percent($student)}}%"
                                                                 aria-valuenow="{{$lesson->percent($student)}}"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                Успеваемость: {{$lesson->points($student)}}
                                                                / {{$lesson->max_points($student)}}</div>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col">
                                        <small class="text-muted"><i class="ion ion-clock"></i> Доступно
                                            с {{$lesson->start_date->format('Y-m-d')}}</small>
                                    </div>
                                    <div class="col">
                                        @if ($user->role=='teacher')
                                            <small class="text-muted float-right" style="margin-right: 15px;">
                                                @foreach($students as $student)
                                                    @if ($lesson->percent($student) < 40)
                                                        <span class="badge badge-danger">&nbsp;</span>
                                                    @elseif($lesson->percent($student) < 60)
                                                        <span class="badge badge-warning">&nbsp;</span>
                                                    @else
                                                        <span class="badge badge-success">&nbsp;</span>
                                                    @endif
                                                @endforeach

                                                <a style="margin-left: 10px;" data-toggle="collapse"
                                                   href="#marks{{$lesson->id}}" aria-expanded="false"
                                                   aria-controls="marks{{$lesson->id}}"><i
                                                            class="ion ion-stats-bars"></i> Статистика
                                                </a>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        @if ($user->role != 'teacher' and !$completed)
            <p style="text-align: center"><a class="btn btn-success btn-lg" href="{{url('/insider/courses/'.$course->id.'/questions')}}">Пройти итоговый тест и получить свидетельство</a></p>
        @endif
    </div>
    @if ($user->role=='teacher')
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Информация</h4>
                    <p>
                        @if ($user->role=='teacher')
                            <b>Статус:</b> {{$course->state}}<br/>
                            <b>Инвайт:</b> {{$course->invite}}<br/>
                            <b>Дистанционно:</b> {{$course->remote_invite}}<br/>

                        @endif
                        @if ($course->git!=null)
                            <b><img src="https://png.icons8.com/git/color/24" title="Git" width="16" height="16"> Git
                                репозиторий:</b> <a href="{{$course->git}}">{{$course->git}}</a><br/>
                        @endif
                        @if ($course->telegram!=null)
                            <b><img src="https://png.icons8.com/telegram-app/win10/16" title="Telegram App" width="16"
                                    height="16"> Чат в телеграм:</b> <a
                                    href="{{$course->telegram}}">{{$course->telegram}}</a><br/>
                        @endif
                    </p>
                    <p>
                        <b>Преподаватели:</b>
                    </p>
                    <ul>
                        @foreach($course->teachers as $teacher)
                            <li><a class="black-link"
                                   href="{{url('/insider/profile/'.$teacher->id)}}">{{$teacher->name}}</a></li>
                        @endforeach
                    </ul>
                    <p>
                        <b>Участники:</b>
                    </p>
                    <ul>
                        @foreach($students->sortByDesc('percent') as $student)
                            <li><a class="black-link"
                                   href="{{url('/insider/profile/'.$student->id)}}">{{$student->name}}</a> <span
                                        class="badge badge-primary float-right"> {{ round($student->percent) }}
                                    % </span></li>
                        @endforeach
                    </ul>

                    @if ($user->role=='teacher')
                        <p>
                            <a href="{{url('insider/courses/'.$course->id.'/assessments')}}" class="btn btn-primary">Успеваемость</a>
                        </p>
                    @endif

                </div>
            </div>
        </div>
    @endif




@endsection
