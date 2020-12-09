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
                @if ($completed->mark >= 50)
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
                    Для получения свидетельства по курсу вам необходимо изучить материалы ниже и набрать не менее 50% правильных ответов в итоговом тесте. Итоговый тест можно пройти только один раз.

                    <br><br>
                    <a href="{{url('insider/courses/'.$course->id.'/questions/')}}">Пройти итоговый тест.</a>
                </div>
            @endif
        @endif

        <div class="alert alert-success" style="margin-top: 15px;" role="alert">
            <h4 class="alert-heading">Внимание!</h4>
            <p>Если Вы планируете получить баллы в рамках НМО и удостоверение о повышении квалификации по выбранному курсу, Вам необходимо дополнительно зарегистрироваться на курс на
                https://edu.rosminzdrav.ru/.</p>
            <hr>
            <p>
                <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Как это сделать?
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <ul>
                    <li>Перейдите с компьютера на сайт https://edu.rosminzdrav.ru/, получите логин и пароль и войдите в личный кабинет.</li>
                    <li>Зайдите в раздел <b>«МОЙ ПЛАН»</b>.</li>
                    <li>Откройте вкладку <b>«ДОБАВИТЬ ЭЛЕМЕНТЫ»</b>.</li>
                    <li>Выберите цикл <b>«Основы диетотерапии онкологических пациентов (взрослых и детей)</b>.</li>
                </ul>

                <p>Текстовый поиск позволяет найти образовательное мероприятие при вводе полностью названия в строку поиска. Выберите справа дату 07.12.2020 и в графе напротив цикла нажмите на «Выбрать цикл» (курс числится как очный, бюджетный, с применением дистанционных технологий).</p>
                <p>По вопросам получения удостоверения государственного образца о повышении квалификации по изученной теме обращаться umc-rnc@nmicrk.ru</p>
            </div>
        </div>

        @foreach($course->lessons as $key => $lesson)
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
                                <div class="row">
                                    <div class="col">
                                        <small class="text-muted"><i class="ion ion-clock"></i> Доступно
                                            с {{$lesson->start_date->format('Y-m-d')}}</small>
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
                        @foreach($course->students->sortByDesc('percent') as $student)
                            <li><a class="black-link"
                                   href="{{url('/insider/profile/'.$student->id)}}">{{$student->name}}</a> </li>
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
