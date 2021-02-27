<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//New Ticket creating
// Route::get('new_ticket', 'TicketsController@create');
Route::get('/new_ticket', 'App\Http\Controllers\TicketsController@create');


//Ticket Storing
Route::post('/new_ticket', 'App\Http\Controllers\TicketsController@store');


Route::post('/logout',  [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//See tickets
Route::get('my_tickets', 'App\Http\Controllers\TicketsController@userTickets');

//Viewing specific ticket
Route::get('tickets/{ticket_id}', 'App\Http\Controllers\TicketsController@show');

//Comment
Route::post('/comment', 'App\Http\Controllers\CommentsController@postComment');