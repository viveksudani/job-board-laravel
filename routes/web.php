<?php

use Illuminate\Support\Facades\Route;

use App\Models\Job;

Route::get('/', function () {
    return view('home');
});


// Index
Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->get();
    $jobs = Job::with('employer')->latest()->simplePaginate(5);
    // $jobs = Job::with('employer')->cursorPaginate(5);

     return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function () {

    return view('jobs.create');

    // return view('job', ['job' => $job]);
});

// Show
Route::get('/jobs/{id}', function ($id) {

    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('/jobs', function () {

    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});


// Edit
Route::get('/jobs/{id}/edit', function ($id) {

    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    // authorize (Pending...)
    // Update the job and persist
    $job = Job::findOrFail($id); //null

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // redirect
    return redirect('/jobs/' . $job->id);
});

// Delete
Route::delete('/jobs/{id}', function ($id) {

    // authorize (Pending...)
    // Delete the job
    $job = Job::findOrFail($id)->delete();

    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
