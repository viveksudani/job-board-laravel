<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use \App\Mail\JobPosted;

use \App\Jobs\TranslateJob;

class JobController extends Controller
{
    public function index()
    {
        // $jobs = Job::with('employer')->get();
        $jobs = Job::with('employer')->latest()->simplePaginate(5);
        // $jobs = Job::with('employer')->cursorPaginate(5);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }
    
    public function show(Job $job)
    {
    return view('jobs.show', ['job' => $job]);
        
    }
 
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );

        TranslateJob::dispatch($job);

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // Update the job and persist

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        // redirect
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // Delete the job
        $job->delete();

        return redirect('/jobs'); 
    }
}
