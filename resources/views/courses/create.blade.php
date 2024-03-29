@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY: Добавление курса
@endsection

@section('content')
    <h2><a class="back-link" href="{{url('/insider/courses/')}}"><i
                    class="icon ion-chevron-left"></i></a> Создание курса</h2>
    <div class="row" style="margin-top: 15px;">
        <div class="col">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Название</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required>
                    @if ($errors->has('name'))
                        <span class="help-block error-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea id="description"  class="form-control"  name="description" required>{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block error-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>

            <!--
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Аватар</label>

                            <div class="col-md-8">
                                <input id="image" type="file" class="form-control" name="image"/>

                                @if ($errors->has('image'))
                <span class="help-block error-block">
                    <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                    </div>
                </div>
-->

                <button type="submit" class="btn btn-success">Создать</button>
            </form>
        </div>
    </div>
@endsection
