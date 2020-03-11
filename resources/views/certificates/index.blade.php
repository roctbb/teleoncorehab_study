@extends('layouts.app')

@section('content')
    <h3 class="lead" style="margin-left:15px;">Очередь на получение сертификатов</h3>
    <div class="row" style="margin-top: 15px;margin-left: 0;margin-right: 0;">
        @foreach($pending as $item)
            <div class="col-md-4 col-sm-4 col-6 col-lg-3" style="margin-bottom: 15px; padding: 5px;">

                <div class="card bg-dark">
                    <div class="card-header"><a
                                href="{{url('/insider/profile/'.$item->user->id)}}"><i
                                    class="icon ion-person"></i>&nbsp;{{$item->user->name}}</a></div>
                    <div class="card-body"
                         style="padding: 10px;">
                        <ul class="card-text">
                            <li>Курс: {{ $item->name }}</li>
                            <li>Оценка: {{ $item->mark}} %</li>
                        </ul>

                        <a href="{{url('/insider/certificates/'.$item->id.'/deliver')}}" onclick="return confirm('Отметить сертификат, как выданный?');">Отметить, как выданный.</a>

                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <h3 class="lead" style="margin-left:15px;">Выданные свидетельства</h3>
    <div class="row" style="margin-top: 15px;margin-left: 0;margin-right: 0;">
        @foreach($delivered as $item)
            <div class="col-md-4 col-sm-4 col-6 col-lg-3" style="margin-bottom: 15px; padding: 5px;">

                <div class="card bg-dark">
                    <div class="card-header"><a
                                href="{{url('/insider/profile/'.$item->user->id)}}"><i
                                    class="icon ion-person"></i>&nbsp;{{$item->user->name}}</a></div>
                    <div class="card-body"
                         style="padding: 10px;">
                        <ul class="card-text">
                            <li>Курс: {{ $item->name }}</li>
                            <li>Оценка: {{ $item->mark}} %</li>
                        </ul>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <h3 class="lead" style="margin-left:15px;">Проваленные тесты</h3>
    <div class="row" style="margin-top: 15px;margin-left: 0;margin-right: 0;">
        @foreach($denied as $item)
            <div class="col-md-4 col-sm-4 col-6 col-lg-3" style="margin-bottom: 15px; padding: 5px;">

                <div class="card bg-dark">
                    <div class="card-header"><a
                                href="{{url('/insider/profile/'.$item->user->id)}}"><i
                                    class="icon ion-person"></i>&nbsp;{{$item->user->name}}</a></div>
                    <div class="card-body"
                         style="padding: 10px;">
                        <ul class="card-text">
                            <li>Курс: {{ $item->name }}</li>
                            <li>Оценка: {{ $item->mark}} %</li>
                        </ul>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

@endsection
