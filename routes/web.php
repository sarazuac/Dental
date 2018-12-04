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

Auth::routes([

    
]);

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware' => 'can:accessAdmin'], function() {
  
//     // future adminpanel routes also should belong to the group
// });

Route::middleware('auth')->get('/timesheets', 'TimesheetController@getTimesheets')->name('timesheets');


Route::middleware('auth')->get('/timesheet', 'TimesheetController@getTimesheetsByUser')->name('timesheet');


Route::middleware('auth')->put('/timesheet/edit', 'TimesheetController@putTimesheet')->name('timesheet edit');

Route::middleware('auth')->get('/clockin', 'TimesheetController@postClockIn')->name('clockin');

Route::middleware('auth')->get('/lunchin/{id}', 'TimesheetController@putLunchIn')->name('lunchin');

Route::middleware('auth')->get('/lunchout/{id}', 'TimesheetController@putLunchOut')->name('lunchout');

Route::middleware('auth')->get('/clockout/{id}', 'TimesheetController@putClockOut')->name('clockout');



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
