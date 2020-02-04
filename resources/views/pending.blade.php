@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <h2> Заявка на рассмотрении</h2>

            <p style="margin-top: 30px;">Уважаемый (ая), {{ \Auth::User()->name }}, ваша заявка на подключение к курсам повышения квалификации TeleOncoRehab study находится на стадии рассмотрения. Как только мы проверим вашу анкету, вы получите доступ к курсу.</p>

            <p>Когда все будет готово, мы пришлем вам письмо на почту <strong>{{ \Auth::User()->name }}</strong>. Если у вас есть вопросы, вы можете связаться с нами по адресу roctbb@gmail.com</p>
        </div>

    </div>



@endsection
