@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <h3 style="font-weight: 300;">Регистрация по программу повышения квалификации <strong>"Основы реабилитации онкологических пациентов (72 часа)"</strong>.</h3>


                    <div class="row" style="margin-top: 30px;">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <h5>Информация об аккаунте</h5>

                                    <div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label  class="control-label" for="email">E-Mail</label>


                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        <span class="help-block text-muted">Ваш действующий Email адрес, он будет вашим логином.</span>

                                        @if ($errors->has('email'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif

                                    </div>

                                    <div class="form-group required{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="control-label">Пароль</label>


                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif

                                    </div>

                                    <div class="form-group required">
                                        <label for="password-confirm" class="control-label">Повторите
                                            пароль</label>


                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>

                                    </div>
                                    <h5>Персональная информация</h5>
                                    <div class="form-group required">
                                        <label  class="control-label" for='name'>ФИО</label>

                                        <input id='name' type="text" class="form-control" name='name'
                                               value="{{old('name')}}"
                                               required>

                                        <span class="help-block text-muted">Ваше имя, фамилия и отчество.</span>

                                        @if ($errors->has('name'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='gender'>Пол</label>


                                        <select id='gender' class="form-control" name='gender'>
                                            <option value="male" @if (old('gender') == 'male') selected @endif>Мужской</option>
                                            <option value="female" @if (old('gender') == 'female') selected @endif>Женский</option>
                                        </select>

                                        @if ($errors->has('gender'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('gender') }}</strong></span>
                                        @endif
                                    </div>


                                    <div class="form-group required">
                                        <label  class="control-label" for='birthday'>Дата рождения</label>

                                        <input id='birthday' type="date" class="form-control date" name='birthday'
                                               value="{{old('birthday')}}" required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('birthday'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='country'>Гражданство</label>

                                        <input id='country' type="text" class="form-control" name='country'
                                               value="{{old('country')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('country'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='address'>Адрес постоянного места жительства</label>
                                        <textarea id="address" class="form-control"
                                                  name="address">{{old('address')}}</textarea>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('address'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='phone'>Контактный телефон</label>

                                        <input id='phone' type="text" class="form-control" name='phone'
                                               value="{{old('phone')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('phone'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <h5>Информация об образовании</h5>

                                    <div class="form-group required">
                                        <label  class="control-label" for='university_name'>Полное наименование высшего учебного заведения</label>

                                        <input id='university_name' type="text" class="form-control" name='university_name'
                                               value="{{old('university_name')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('university_name'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('university_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label  class="control-label" for='university_diploma'>Серия и номер диплом</label>

                                        <input id='university_diploma' type="text" class="form-control" name='university_diploma'
                                               value="{{old('university_diploma')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('university_diploma'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('university_diploma') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label  class="control-label" for='university_year'>Год окончания</label>


                                        <input id='university_year' type="number" min="1900" max="2500" class="form-control" name='university_year'
                                               value="{{old('university_year')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('university_year'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('university_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>


                                    <div class="form-group required">
                                        <label  class="control-label" for='internship_name'>Специальность прохождения <strong>интернатуры</strong></label>

                                        <input id='internship_name' type="text" class="form-control" name='internship_name'
                                               value="{{old('internship_name')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('internship_name'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('internship_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='internship_year'>Год окончания</label>


                                        <input id='internship_year' type="number" min="1900" max="2500" class="form-control" name='internship_year'
                                               value="{{old('internship_year')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('internship_year'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('internship_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='postgraduate_name'>Специальность прохождения <strong>аспирантуры</strong></label>

                                        <input id='postgraduate_name' type="text" class="form-control" name='postgraduate_name'
                                               value="{{old('postgraduate_name')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('postgraduate_name'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('postgraduate_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='postgraduate_year'>Год окончания</label>


                                        <input id='postgraduate_year' type="number" min="1900" max="2500" class="form-control" name='postgraduate_year'
                                               value="{{old('postgraduate_year')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('postgraduate_year'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('postgraduate_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label" for='courses'>Профессиональная переподготовка</label>
                                        <textarea id="courses" class="form-control"
                                                  name="courses">{{old('courses')}}</textarea>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('courses'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('courses') }}</strong></span>
                                        @endif
                                    </div>


                                    <div class="form-group required">
                                        <label  class="control-label" for='certificate_number'>Сертификат специалиста №</label>

                                        <input id='certificate_number' type="text" class="form-control" name='certificate_number'
                                               value="{{old('certificate_number')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('certificate_number'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='certificate_specialty'>Специальность</label>

                                        <input id='certificate_specialty' type="text" class="form-control" name='certificate_specialty'
                                               value="{{old('certificate_specialty')}}"
                                               required>

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('certificate_specialty'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_specialty') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='certificate_year'>Год выдачи</label>


                                        <input id='certificate_year' type="number" min="1900" max="2500" class="form-control" name='certificate_year'
                                               value="{{old('certificate_year')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('certificate_year'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>


                                    <h5>Работа</h5>

                                    <div class="form-group required">
                                        <label  class="control-label" for='job_years'>Стаж по специальности</label>


                                        <input id='job_years' type="number" min="0" max="2500" class="form-control" name='job_years'
                                               value="{{old('job_years')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('job_years'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('job_years') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='job_title'>Занимаемая должность в настоящее время</label>


                                        <input id='job_title' type="text" class="form-control" name='job_title'
                                               value="{{old('job_title')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('job_title'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label  class="control-label" for='job_place'>Место основной работы</label>

                                        <textarea id="job_place" class="form-control"
                                                  name="job_place">{{old('job_place')}}</textarea>
                                        <span class="help-block text-muted">наименование учреждения, министерства или ведомства по подчиненности, структурного подразделения, адрес</span>

                                        @if ($errors->has('job_place'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('job_place') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="col">
                            <button style="margin-bottom: 50px;" type="submit" class="btn btn-success">Оставить заявку на прохождение курса</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
