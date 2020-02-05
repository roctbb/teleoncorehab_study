@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <h2><a class="back-link" href="{{url('/insider/courses/'.$course->id)}}"><i
                            class="icon ion-chevron-left"></i></a>&nbsp; Результаты теста по курсу "{{ $course->name }}"</h2>

            <p style="margin-top: 30px;">Тест еще не пройден.</p>
        </div>

    </div>



@endsection
