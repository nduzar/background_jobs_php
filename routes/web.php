<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-background-job', function () {
    runBackgroundJob(App\Jobs\ExampleJob::class, 'handle');
    return 'Background job dispatched';
});
