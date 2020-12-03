@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <h3 style="font-weight: 300;">Регистрация на образовательные программы на платформе TELEONCOREHAB STUDY</h3>

                    <div class="alert alert-success" style="margin-top: 15px;" role="alert">
                        <h4 class="alert-heading">Внимание!</h4>
                        <p>Если Вы планируете получить баллы в рамках НМО и удостоверение о повышении квалификации по выбранному курсу, Вам необходимо дополнительно зарегистрироваться на курс на
                            https://edu.rosminzdrav.ru/.</p>
                        <hr>
                        <p>
                            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Как это сделать?
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <ul>
                                <li>Перейдите с компьютера на сайт https://edu.rosminzdrav.ru/, получите логин и пароль и войдите в личный кабинет.</li>
                                <li>Зайдите в раздел <b>«МОЙ ПЛАН»</b>.</li>
                                <li>Откройте вкладку <b>«ДОБАВИТЬ ЭЛЕМЕНТЫ»</b>.</li>
                                <li>Выберите цикл <b>«Основы диетотерапии онкологических пациентов (взрослых и детей)</b>.</li>
                            </ul>

                            <p>Текстовый поиск позволяет найти образовательное мероприятие при вводе полностью названия в строку поиска. Выберите справа дату 07.12.2020 и в графе напротив цикла нажмите на «Выбрать цикл» (курс числится как очный, бюджетный, с применением дистанционных технологий).</p>
                            <p>По вопросам получения удостоверения государственного образца о повышении квалификации по изученной теме обращаться umc-rnc@nmicrk.ru</p>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 30px;">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <h5>Информация об аккаунте</h5>

                                    <div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label" for="email">E-Mail</label>


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
                                        <label class="control-label" for='name'>ФИО</label>

                                        <input id='name' type="text" class="form-control" name='name'
                                               value="{{old('name')}}"
                                               required>

                                        <span class="help-block text-muted">Ваша фамилия, имя и отчество.</span>

                                        @if ($errors->has('name'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>


                                    <div class="form-group required">
                                        <label class="control-label" for='birthday'>Дата рождения</label>

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
                                        <label class="control-label" for='country'>Гражданство</label>

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
                                        <label class="control-label" for='address'>Город</label>
                                        <input id="address" class="form-control"
                                               name="address" value="{{old('address')}}"/>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('address'))
                                            <span class="help-block error-block"><strong>{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for='phone'>Контактный телефон</label>

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
                                        <label class="control-label" for='university_name'>Полное наименование высшего
                                            учебного заведения</label>

                                        <input id='university_name' type="text" class="form-control"
                                               name='university_name'
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
                                        <label class="control-label" for='university_year'>Год окончания</label>


                                        <input id='university_year' type="number" min="1900" max="2500"
                                               class="form-control" name='university_year'
                                               value="{{old('university_year')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('university_year'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('university_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label" for='certificate_number'>Сертификат специалиста
                                            №</label>

                                        <input id='certificate_number' type="text" class="form-control"
                                               name='certificate_number'
                                               value="{{old('certificate_number')}}">

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('certificate_number'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for='certificate_specialty'>Специальность</label>

                                        <input id='certificate_specialty' type="text" class="form-control"
                                               name='certificate_specialty'
                                               value="{{old('certificate_specialty')}}">

                                        <span class="help-block text-muted"></span>


                                        @if ($errors->has('certificate_specialty'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_specialty') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for='certificate_year'>Год выдачи</label>


                                        <input id='certificate_year' type="number" min="1900" max="2500"
                                               class="form-control" name='certificate_year'
                                               value="{{old('certificate_year')}}">
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('certificate_year'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>


                                    <h5>Работа</h5>

                                    <div class="form-group required">
                                        <label class="control-label" for='job_years'>Стаж по специальности (лет):</label>


                                        <input id='job_years' type="number" min="0" max="2500" class="form-control"
                                               name='job_years'
                                               value="{{old('job_years')}}"
                                               required>
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('job_years'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('job_years') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for='job_title'>Занимаемая должность в настоящее
                                            время</label>


                                        <input id='job_title' type="text" class="form-control" name='job_title'
                                               value="{{old('job_title')}}">
                                        <span class="help-block text-muted"></span>

                                        @if ($errors->has('job_title'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for='job_place'>Место основной работы</label>

                                        <textarea id="job_place" class="form-control"
                                                  name="job_place">{{old('job_place')}}</textarea>
                                        <span class="help-block text-muted">наименование учреждения, министерства или ведомства по подчиненности, структурного подразделения, адрес</span>

                                        @if ($errors->has('job_place'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('job_place') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <h5>Необходимые документы</h5>

                                    <div class="form-group required">
                                        <label class="control-label" for='diploma_file'>Копия диплома:</label>

                                        <input id='diploma_file' type="file" class="form-control" name='diploma_file'
                                               value="{{old('diploma_file')}}"
                                               required>

                                        <span class="help-block text-muted">Копия диплома об окончании медицинского (высшего или среднего) учебного заведения (документа, подтверждающего установление эквивалентности полученного за рубежом образования российскому).</span>

                                        @if ($errors->has('diploma_file'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('diploma_file') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for='surname_file'>Копия документа о смене фамилии
                                            (необязательно):</label>

                                        <input id='surname_file' type="file" class="form-control" name='surname_file'
                                               value="{{old('surname_file')}}">

                                        @if ($errors->has('surname_file'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('surname_file') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for='certificate_file'>Копия действующего
                                            сертификата специалиста:</label>

                                        <input id='certificate_file' type="file" class="form-control"
                                               name='certificate_file'
                                               value="{{old('certificate_file')}}"
                                               required>

                                        @if ($errors->has('certificate_file'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('certificate_file') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for='snils_file'>Копия СНИЛС:</label>

                                        <input id='snils_file' type="file" class="form-control" name='snils_file'
                                               value="{{old('snils_file')}}"
                                               required>

                                        @if ($errors->has('snils_file'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('snils_file') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for='passport_file'>Копия паспорта:</label>

                                        <input id='passport_file' type="file" class="form-control" name='passport_file'
                                               value="{{old('passport_file')}}"
                                               required>

                                        <span class="help-block text-muted">Первый "разворот" и страница с регистрацией.</span>

                                        @if ($errors->has('passport_file'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('passport_file') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for='request_file'>Скан заявки на прохождение курса на портале www.edu.rosminzdrav.com</label>

                                        <input id='request_file' type="file" class="form-control" name='request_file'
                                               value="{{old('request_file')}}"
                                               required>

                                    <!--<span class="help-block text-muted">Копия <a target="_blank" href="{{url('/zayavlenie.pdf')}}">заявление на зачиление на курс «Основы реабилитации онкологических пациентов», 72 часа</a>. Его нужно распечатать, заполнить и отсканировать.</span>-->

                                        @if ($errors->has('request_file'))
                                            <span class="help-block error-block">
                                        <strong>{{ $errors->first('request_file') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for='confirm'>На зачисление на курс и обработку персональных данных согласен</label>

                                        <input id='confirm' type="checkbox" name='confirm'
                                               value="on" required>

                                    <!--<span class="help-block text-muted">Копия <a target="_blank" href="{{url('/zayavlenie.pdf')}}">заявление на зачиление на курс «Основы реабилитации онкологических пациентов», 72 часа</a>. Его нужно распечатать, заполнить и отсканировать.</span>-->

                                        @if ($errors->has('confirm'))
                                            <span class="help-block error-block">
                                        <strong>Подтвердите свое согласие</strong>
                                    </span>
                                        @endif
                                    </div>


                                </div>


                            </div>


                            <div class="col">
                                <button style="margin-bottom: 50px;" type="submit" class="btn btn-lg btn-success">выбрать курс и приступить к обучению</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
