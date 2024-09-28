<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
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
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required'],
        ]);

        $job = Job::create([
            'title' => request('title'),
            'description' => request('description'),
            'employer_id' => 1,
        ]);

        Mail::to($job->employer->user)->queue(new \App\Mail\JobPosted($job));

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        Gate::authorize('edit-job', $job);

        //validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required'],
        ]);
        //authorize
        // update
        $job->update([
            'title' => request('title'),
            'description' => request('description'),
        ]);
        // and persist
        // redirect to the Job's page
        return redirect("/jobs/{$job->id}");
    }

    public function destroy(Job $job)
    {
        //authorize
        Gate::authorize('edit-job', $job);

        //delete the job
        $job->delete();
        //redirect to the jobs page
        return redirect('/jobs');
    }
}
