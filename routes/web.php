<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
     return view('jobs', [
        'jobs' => [
            [
                'id' => 1,
                'title' => 'Python Developer',
                'salary' => '$50,000' 
            ],
            [
                'id' => 2,
                'title' => 'Vue.js Developer',
                'salary' => '$60,000' 
            ],
            [
                'id' => 3,
                'title' => 'Django Developer',
                'salary' => '$65,000' 
            ],
        ]
    ]);
});


Route::get('/job/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'title' => 'Python Developer',
            'salary' => '$50,000' 
        ],
        [
            'id' => 2,
            'title' => 'Vue.js Developer',
            'salary' => '$60,000' 
        ],
        [
            'id' => 3,
            'title' => 'Django Developer',
            'salary' => '$65,000' 
        ],
    ];

    
    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);

    return view('job', ['job' => $job]);
});


Route::get('/contact', function () {
    return view('contact');
});
