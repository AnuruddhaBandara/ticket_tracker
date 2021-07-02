<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CommentsController;

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

//new ticket creating
Route::get('/new_ticket', [TicketsController::class, 'create']);
//ticket storing
Route::post('/new_ticket', [TicketsController::class, 'store']);
//See tickets
Route::get('/my_tickets', [TicketsController::class, 'userTickets']);
//Viewing specific ticket
Route::get('tickets/{ticket_id}', [TicketsController::class,'show']);
//Comment
Route::post('/comment', [CommentsController::class,'postComment']);
//search by customer name
Route::get('/search',[TicketsController::class, 'search'])->name('web.search');;
