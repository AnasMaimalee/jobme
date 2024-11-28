<?php

namespace App\Services;

use App\Repositories\JobRepository;
use App\Models\Job;

class JobService
{
    protected $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    // Get all jobs with pagination
    public function getAllJobs($perPage = 10)
    {
        return $this->jobRepository->getAllJobs($perPage);
    }

    // Get jobs for a specific user (employer)
    public function getUserJobs($userId)
    {
        $perPage = 10;
        return $this->jobRepository->getJobsByUser($userId, $perPage);
    }

    // Create a new job
    public function createJob(array $attributes)
    {
        return $this->jobRepository->createJob($attributes);
    }

    // Update an existing job
    public function updateJob(Job $job, array $attributes)
    {
        return $this->jobRepository->updateJob($job, $attributes);
    }

    // Delete a job
    public function deleteJob(Job $job)
    {
        return $this->jobRepository->deleteJob($job);
    }
}
