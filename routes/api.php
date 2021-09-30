<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'reminder', 'namespace' => 'App\Api\Controllers\Reminder'], function () {
    Route::post('add', 'ReminderController@addReminder')->name('reminder.add'); //Api for creating a reminder
    Route::put('update/{id}', 'ReminderController@updateReminder')->name('reminders.update'); //Api for updating a reminder desc, date and status
    Route::get('get', 'ReminderController@getReminders')->name('reminders.show'); //get reminders
    Route::delete('delete', 'ReminderController@deleteReminders')->name('reminders.delete'); //Api for deleting a reminder
});
