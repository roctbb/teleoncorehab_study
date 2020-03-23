@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <h2> Курсы</h2>
        </div>
        <div class="col">
            @if ($user->role=='teacher')
                <a class="float-right btn btn-success btn-sm" href="{{url('/insider/courses/create/')}}"><i
                            class="icon ion-plus-round"></i>&nbsp;Создать</a>
            @endif
        </div>
    </div>
        @if ($courses->where('state', 'started')->count()!=0)
            <div class="row" style="margin-top: 15px;">


                <div class="card-deck">

                    @foreach($courses as $course)
                        @if ($course->state == 'started')

                            <div class="card"
                                 style="min-width: 280px; background-image: url({{$course->image}}); background-size: cover;">

                                <!--<img class="card-img-top" src="..." alt="Card image cap">-->
                                <div class="card-body" style="background-color: rgba(255,255,255,0.9);">
                                    <h4 style="margin-top: 15px;" class="card-title">{{$course->name}}</h4>
                                    <p class="card-text">{{$course->description}}</p>

                                </div>
                                <div class="card-footer" style="background-color: rgba(245,245,245,1);">
                                    @if ($user->role=='teacher' || $course->students->contains($user))
                                        <a href="{{url('insider/courses/'.$course->id)}}" class="btn btn-success">&nbsp;Страница курса</a>
                                    @else
                                        <a class="btn btn-primary" role="button" href="{{url('insider/courses/'.$course->id.'/enroll')}}">Записаться</a>
                                    @endif

                                    @if ($course->site != null)
                                        <a target="_blank" href="{{$course->site}}" style="margin-top: 6px;"
                                           class="float-right">О курсе</a>
                                    @endif
                                </div>
                            </div>

                        @endif
                    @endforeach
                </div>

            </div>

            @if ($user->role == 'student')
                <div class="row" style="margin-top: 15px;">
                    <div class="col">
                        <h5>Мультимедийная телеобучающая платформа «TELEONCOREHAB STUDY»:</h5>

                        <ul>
                            <li>принципы и этапы реабилитации в онкологии;</li>
                            <li>клинические рекомендации;</li>
                            <li>основные технологические приемы;</li>
                            <li>наукометрический анализ исследований;</li>
                            <li>повышение квалификации онкологов и реабилитологов.</li>
                        </ul>

                        <img style="width: 150px;" src="{{ url('fond.png') }}"/>
                    </div>
                </div>
            @endif
        @endif
    @if ($user->role == 'teacher')
        <div class="row" style="margin-top: 15px;">
            <div class="col">
                <h2> Черновики</h2>
            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="card-deck">
                @foreach($courses as $course)
                    @if ($course->state == 'draft')

                        <div class="card"
                             style="min-width: 280px; background-image: url({{$course->image}}); background-size: cover;">
                            <!--<img class="card-img-top" src="..." alt="Card image cap">-->
                            <div class="card-body" style="background-color: rgba(255,255,255,0.9);">
                                <h4 class="card-title">{{$course->name}}</h4>
                                <p class="card-text">{{$course->description}}</p>
                                <a href="{{url('insider/courses/'.$course->id)}}" class="btn btn-primary">Страница
                                    курса</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

        <div class="row" style="margin-top: 15px;">
            <div class="col">
                <h2> Архив</h2>
            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="card-deck">
                @foreach($courses as $course)
                    @if ($course->state == 'ended')

                        <div class="card" style="width: 100%; min-width: 280px; background-image: url({{$course->image}}); background-size: cover;">
                            <div class="card-body" style="background-color: rgba(255,255,255,0.9);">
                                <h4 class="card-title">{{$course->name}}</h4>
                                <p class="card-text">{{$course->description}}</p>
                                <a href="{{url('insider/courses/'.$course->id)}}" class="btn btn-primary">Страница
                                    курса</a>
                            </div>
                        </div>

                    @endif
                @endforeach
            </div>
        </div>
    @endif



@endsection
