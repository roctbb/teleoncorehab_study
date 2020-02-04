<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', function () {
    if (\Illuminate\Support\Facades\Auth::check() ) {
        return redirect('/insider');
    }
    return redirect('/login');

});

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check() ) {
        return redirect('/insider');
    }
    return redirect('/login');

});

Auth::routes();

Route::prefix('open')->group(function () {
    Route::get('/steps/{id}', 'OpenStepsController@details');
});

Route::prefix('insider')->middleware(['auth'])->group(function () {
    Route::get('/pending', 'CoursesController@pending');
    Route::get('/decline', 'CoursesController@decline');
});

Route::prefix('insider')->middleware(['auth', 'accepted'])->group(function () {

    #TODO Check
    Route::get('/', function () {
        return redirect('/insider/courses');
    });
    Route::get('/courses', 'CoursesController@index')->name('Courses');

    Route::get('/courses/create', 'CoursesController@createView')->name('Create course');
    Route::post('/courses/create', 'CoursesController@create');

    Route::get('/courses/{id}/', 'CoursesController@details');
    Route::get('/courses/{id}/edit', 'CoursesController@editView');
    Route::get('/courses/{id}/start', 'CoursesController@start');
    Route::get('/courses/{id}/stop', 'CoursesController@stop');
    Route::post('/courses/{id}/edit', 'CoursesController@edit');
    Route::get('/courses/{id}/assessments', 'CoursesController@assessments');
    Route::get('/courses/{id}/export', 'CoursesController@export');
    Route::get('/courses/{id}/enroll', 'CoursesController@enroll');


    Route::get('/courses/{id}/create', 'LessonsController@createView');
    Route::post('/courses/{id}/create', 'LessonsController@create');
    Route::get('/lessons/{id}/edit', 'LessonsController@editView');
    Route::post('/lessons/{id}/edit', 'LessonsController@edit');
    Route::get('/lessons/{id}/export', 'LessonsController@export');
    Route::get('/lessons/{id}/lower', 'LessonsController@makeLower');
    Route::get('/lessons/{id}/upper', 'LessonsController@makeUpper');
    Route::get('/lessons/{id}/delete', 'LessonsController@delete');


    Route::get('/lessons/{id}/create', 'StepsController@createView');
    Route::post('/lessons/{id}/create', 'StepsController@create');
    Route::get('/steps/{id}', 'StepsController@details');
    Route::get('/perform/{id}', 'StepsController@perform');
    Route::get('/steps/{id}/edit', 'StepsController@editView');
    Route::get('/steps/{id}/lower', 'StepsController@makeLower');
    Route::get('/steps/{id}/upper', 'StepsController@makeUpper');
    Route::get('/steps/{id}/delete', 'StepsController@delete');
    Route::post('/steps/{id}/edit', 'StepsController@edit');
    Route::post('/steps/{id}/question', 'StepsController@question');
    Route::post('/steps/{id}/task', 'TasksController@create');

    Route::get('/questions/{id}/delete', 'StepsController@deleteQuestion');
    Route::get('/tasks/{id}/delete', 'TasksController@delete');
    Route::get('/tasks/{id}/edit', 'TasksController@editForm');

    Route::get('/tasks/{id}/up', 'TasksController@toPreviousTask');
    Route::get('/tasks/{id}/down', 'TasksController@toNextTask');
    Route::get('/tasks/{id}/left', 'TasksController@makeLower');
    Route::get('/tasks/{id}/right', 'TasksController@makeUpper');

    Route::post('/tasks/{id}/edit', 'TasksController@edit');
    Route::post('/tasks/{id}/solution', 'TasksController@postSolution');
    Route::get('/tasks/{id}/phantom', 'TasksController@phantomSolution');
    Route::get('/tasks/{id}/student/{student_id}', 'TasksController@reviewSolutions');
    Route::post('/solution/{id}', 'TasksController@estimateSolution');

    Route::get('/requests', 'RequestsController@index');
    Route::get('/profile/{id?}', 'RequestsController@details');


    Route::get('/profile/{id}/edit', 'RequestsController@editView');
    Route::post('/profile/{id}/edit', 'RequestsController@edit');
    Route::post('/profile/{id}/course', 'RequestsController@course');
    Route::get('/profile/{id}/accept', 'RequestsController@accept');
    Route::get('/profile/{id}/decline', 'RequestsController@decline');
    Route::get('/profile/{user_id}/download/{name}', 'RequestsController@download');


});


Route::get('media/{dir}/{name}', 'MediaController@index');
