@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <h2 style="margin-bottom: 30px;"><a class="back-link" href="{{url('/insider/courses/'.$course->id)}}"><i
                            class="icon ion-chevron-left"></i></a>&nbsp; Результаты теста по курсу "{{ $course->name }}"</h2>

            <p><strong>Ваш результат:</strong> {{$completed->mark}} %</p>

            @if ($completed->mark >= 50)
                <div class="alert alert-success" role="alert">
                   Поздравляем, Вы успешно прошли тест! В ближайшее время мы свяжемся с вами по поводу получения свидетельства. Если у вас есть вопросы, свяжитесь с нами по адресу {{ config('app.info_email') }}.
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    К сожалению, Вы не набрали достаточное количество баллов для получения свидетельства. Если у вас есть вопросы, свяжитесь с нами по адресу {{ config('app.info_email') }}.
                </div>
            @endif


                @foreach($questions->sortBy('sort_id') as $question)
                    <div class="card">
                        <div class="card-body">

                            <strong>{{ $question->text }}</strong>
                            <div style="padding: 20px;">
                                @foreach($question->variants as $variant)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_{{$question->id}}" value="{{$variant->id}}" @if ($prepaired_answers[$question->id] == $variant->id) checked @endif>
                                        <label class="form-check-label" @if ($variant->is_correct) style="color: green;" @endif>
                                            {{$variant->text}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>


                @endforeach
        </div>

    </div>



@endsection
