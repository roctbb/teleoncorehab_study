@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <h2> Заявка отклонена</h2>

            <p style="margin-top: 30px;">Уважаемый (ая), {{ \Auth::User()->name }}, к сожалению, ваша заявка на подключение к курсам повышения квалификации TeleOncoRehab study была отклонена. </p>

            @if (\Auth::User()->decline_comment)
                <p>Комментарий к заявке: {{\Auth::User()->decline_comment}}.</p>
            @endif

            <p>Если у вас есть вопросы, вы можете связаться с нами по адресу roctbb@gmail.com</p>
        </div>

    </div>



@endsection
