<?php

use App\Http\Controllers\ApplicantController;
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
    });
});




require __DIR__.'/auth.php';


