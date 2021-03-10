<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;
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

// auth routes
Route::group(['middleware' => 'auth'], function() {

    // dashboard routes
    Route::group(['prefix' => '/dashboard'], function () {

        // main dashboard
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

        // index applicants
        Route::get('/applicant/index', [ApplicantController::class, 'index'])
            ->middleware('can:list,App\Models\Applicant')
            ->name('dashboard.applicant.index');
    });

    //applicant routes
    Route::group(['prefix' => '/applicant/{applicant}'], function () {

        // promote applicant to employee
        Route::put('/employ', [ApplicantController::class, 'employ'])
            ->middleware('can:employ,applicant')
            ->name('applicant.employ');

        // queue a applicant
        Route::put('/queue', [ApplicantController::class, 'queue'])
            ->middleware('can:queue,applicant')
            ->name('applicant.queue');

        // delete a applicant
        Route::delete('/reject', [ApplicantController::class, 'reject'])
            ->middleware('can:reject,applicant')
            ->name('applicant.reject');
    });

    // ticket routes
    Route::group(['prefix' => '/ticket'], function () {

        // store a ticket
        Route::post('/', [TicketController::class, 'store'])
           ->middleware('can:create,App\Models\ticket')
           ->name('ticket.store');

        // template to create a ticket
        Route::get('/create', [TicketController::class, 'create'])
           ->middleware('can:create,App\Models\ticket')
           ->name('ticket.create');

        // index of tickets
        Route::get('/index/{status}', [TicketController::class, 'index'])
            ->middleware('can:list,App\Models\ticket')
            ->name('ticket.index')
            ->where('status','open|closed|waiting|processed',);

        // read a ticket
        Route::get('/{any_ticket}', [TicketController::class, 'show'])
            ->middleware('can:read,any_ticket')
            ->name('ticket.show');

        // store a comment on a ticket
        Route::post('/{ticket}/comment', [CommentController::class, 'store'])
            ->middleware('can:comment,ticket')
            ->name('ticket.comment.store');
    });
});

require __DIR__.'/auth.php';
