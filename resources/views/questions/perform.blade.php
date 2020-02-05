@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <h2 style="margin-bottom: 30px;"> Итоговый тест по курсу "{{ $course->name }}"</h2>

            <form method="post">
                {{ csrf_field() }}
                @foreach($questions->sortBy('sort_id') as $question)
                    <div class="card">
                        <div class="card-body">

                            <strong>{{ $question->text }}</strong>
                            <div style="padding: 20px;">
                                @foreach($question->variants as $variant)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_{{$question->id}}" value="{{$variant->id}}">
                                        <label class="form-check-label">
                                            {{$variant->text}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>


                @endforeach

                <div class="alert alert-warning" role="alert">
                    Будьте внимательны! Тест можно сдать только один раз!
                </div>

                <p style="text-align: center"><button class="btn btn-warning btn-lg" onclick="return confirm('Вы уверены, что хотите сдать тест?');">Сдать!</button></p>


            </form>


        </div>

    </div>



@endsection
