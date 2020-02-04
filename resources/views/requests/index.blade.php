@extends('layouts.app')

@section('content')
    <h3 class="lead" style="margin-left:15px;">Активные завки на присоединение</h3>
    <div class="row" style="margin-top: 15px;margin-left: 0;margin-right: 0;">
        @foreach($pending as $user)
            <div class="col-md-4 col-sm-4 col-6 col-lg-3" style="margin-bottom: 15px; padding: 5px;">

                <div class="card bg-dark">
                    <div class="card-header"><a
                                href="{{url('/insider/profile/'.$user->id)}}"><i
                                    class="icon ion-person"></i>&nbsp;{{$user->name}}</a></div>
                    <div class="card-body"
                         style="padding: 10px;">
                        <ul class="card-text">
                            <li>{{ $user->university_name }}</li>
                            <li>{{ $user->job_title }} ({{ $user->job_place }})</li>
                            <li>{{ $user->certificate_specialty }} ({{ $user->certificate_year }})</li>
                        </ul>

                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <h3 class="lead" style="margin-left:15px;">Отказы</h3>
    <div class="row" style="margin-top: 15px;margin-left: 0;margin-right: 0;">
        @foreach($declined as $user)
            <div class="col-md-4 col-sm-4 col-6 col-lg-3" style="margin-bottom: 15px; padding: 5px;">

                <div class="card bg-dark ">
                    <div class="card-header"><a
                                href="{{url('/insider/profile/'.$user->id)}}"><i
                                    class="icon ion-person"></i>&nbsp;{{$user->name}}</a></div>
                    <div class="card-body"
                         style="padding: 10px;">
                        <ul class="card-text">
                            <li>{{ $user->university_name }}</li>
                            <li>{{ $user->job_title }} ({{ $user->job_place }})</li>
                            <li>{{ $user->certificate_specialty }} ({{ $user->certificate_year }})</li>
                        </ul>

                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <h3 class="lead" style="margin-left:15px;">Принятые заявки</h3>
    <div class="row" style="margin-top: 15px;margin-left: 0;margin-right: 0;">
        @foreach($accepted as $user)
            <div class="col-md-4 col-sm-4 col-6 col-lg-3" style="margin-bottom: 15px; padding: 5px;">

                <div class="card bg-dark ">
                    <div class="card-header"><a
                                href="{{url('/insider/profile/'.$user->id)}}"><i
                                    class="icon ion-person"></i>&nbsp;{{$user->name}}</a></div>
                    <div class="card-body" style="padding: 10px;">
                        <ul class="card-text">
                            <li>{{ $user->university_name }}</li>
                            <li>{{ $user->job_title }} ({{ $user->job_place }})</li>
                            <li>{{ $user->certificate_specialty }} ({{ $user->certificate_year }})</li>
                        </ul>

                    </div>
                </div>

            </div>
        @endforeach
    </div>

@endsection
