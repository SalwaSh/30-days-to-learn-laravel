<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\SessionCollector; // Add this line
use App\Jobs\translateJob;
use App\Mail\JobPosted;
use App\Policies\JobPolicy;
use App\Models\Job;

// Route::view('/','home');
// Route::view('/contact', 'contact');

// Route::resource('jobs', JobController::class)->only(['index','show' ]);
// Route::resource('jobs', JobController::class)->except(['index','show' ])->middleware('auth');


// //auth
// Route::get('/register', [RegistredUserController::class, 'create']);
// Route::post('/register', [RegistredUserController::class, 'store']);

// Route::get('/login', [SessionCollector::class, 'create'])->name('login');
// Route::post('/login', [SessionCollector::class, 'store']);
// Route::post('/logout', [SessionCollector::class, 'destroy']);

// Route::get('test', function(){
//     $job = \App\Models\Job::first();
//     translateJob::dispatch($job);
//     return "Done";
// });

// Route::view('/','home');
// Route::view('/contact', 'contact');

// Route::get('jobs', [JobController::class, 'index']);
// Route::get('jobs/create', [JobController::class, 'create']);
// Route::post('jobs', [JobController::class, 'store'])->middleware('auth');
// Route::get('jobs/{job}', [JobController::class, 'show']);
// Route::get('jobs/{job}/edit', [JobController::class, 'edit'])
// ->middleware('auth')
// ->can('edit', '$job');
// Route::put('jobs/{job}', [JobController::class, 'update']);
// Route::delete('jobs/{job}', [JobController::class, 'destroy']);

// //auth
// Route::get('/register', [RegistredUserController::class, 'create']);
// Route::post('/register', [RegistredUserController::class, 'store']);

// Route::get('/login', [SessionCollector::class, 'create'])->name('login');
// Route::post('/login', [SessionCollector::class, 'store']);
// Route::post('/logout', [SessionCollector::class, 'destroy']);




Route::get('test', function () {
    $job = Job::first();

    TranslateJob::dispatch($job);

    return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

 Route::get('/jobs', [JobController::class, 'index']);
 Route::get('/jobs/create', [JobController::class, 'create']);
 Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
 Route::get('/jobs/{job}', [JobController::class, 'show']);

 Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
     ->middleware('auth')
     ->can('edit', 'job');

 Route::patch('/jobs/{job}', [JobController::class, 'update']);
 Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegistredUserController::class, 'create']);
Route::post('/register', [RegistredUserController::class, 'store']);

Route::get('/login', [SessionCollector::class, 'create'])->name('login');
Route::post('/login', [SessionCollector::class, 'store']);
Route::post('/logout', [SessionCollector::class, 'destroy']);

