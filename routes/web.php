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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/timesheets', 'TimesheetController@getTimesheets')->name('timesheets');

Route::get('/timesheet', 'TimesheetController@getTimestampsByUser')->name('timesheet');


Route::get('/lunchin/{id}', 'TimesheetController@putLunchIn')->name('lunchin');



// $router->get('/timestamps', [
//     'uses' => 'TimestampController@getTimestamps'
// ]);
// $router->get('/timestamp/user/{user_id}', [
//     'uses' => 'TimestampController@getTimestampsByUser'
// ]);

// $router->post('/timestamp/clockin', [
//     'uses' => 'TimestampController@postClockIn'
// ]);
// $router->put('/timestamp/lunchin/{id}', [
//     'uses' => 'TimestampController@postLunchIn'
// ]);
// $router->put('/timestamp/lunchout/{id}', [
//     'uses' => 'TimestampController@postLunchOut'
// ]);
// $router->put('/timestamp/clockout/{id}', [
//     'uses' => 'TimestampController@postClockOut'
// ]);
// $router->delete('/timestamp/{id}', [
//     'uses' => 'TimestampController@deleteTimestamp'
// ]);

// Route::any('/{any}', 'HomeController@index')->where('any', '.*');
