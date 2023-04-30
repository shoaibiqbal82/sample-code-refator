<?php

namespace App\Interfaces;

interface JobRepositoryInterface
{
    public function getAllJobs();
    public function getCustomerJobs($userId, $job_type);
    public function getTranslatorJobs($userId, $job_type);
    public function deleteJob($jobId);
    public function createJob(array $jobDetails);
    public function updateJob($jobId, array $newDetails);
}