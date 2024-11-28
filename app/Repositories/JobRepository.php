<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository
{
// Fetch all jobs (or a paginated list)
    public function getAllJobs($perPage = 10)
    {
        return Job::paginate($perPage);
    }

// Fetch jobs for a specific employer (user)
    public function getJobsByUser($userId, $perPage = 10)
    {
        return Job::where('employer_id', $userId)->paginate($perPage);
    }

// Store a new job
    public function createJob(array $attributes)
    {
        return Job::create($attributes);
    }

// Update an existing job
    public function updateJob(Job $job, array $attributes)
    {
        $job->update($attributes);
        return $job;
    }

// Delete a job
    public function deleteJob(Job $job)
    {
        $job->delete();
    }
}
