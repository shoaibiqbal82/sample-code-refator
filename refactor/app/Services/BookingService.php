<?php

namespace App\Services;


use App\Repository\UserRepository;
use App\Repository\JobRepository;
use App\Notifications\BookingConfirmed;

class BookingService
{
    public function getUsersJobs(
        Request $request,
        UserRepository $userRepository,
        JobRepository $jobRepository
    ) {
        if ($user_id = $request->get('user_id')) {
            $user = $userRepository->getUserById($user_id);
            $user_type = $userRepository->getUserType($user_id);

            if ($user_type == 'customer') {
                $emergencyJobs = $jobRepository->getCustomerJobs($user_id, 'yes');
                $noramlJobs = $jobRepository->getCustomerJobs($user_id, 'no');
            } else {
                $emergencyJobs = $jobRepository->getTranslatorJobs($user_id, 'yes');
                $noramlJobs = $jobRepository->getTranslatorJobs($user_id, 'no');
            }

            return ['emergencyJobs' => $emergencyJobs, 'noramlJobs' => $noramlJobs, 'cuser' => $user, 'usertype' => $user_type];
        } elseif (
            $request->__authenticatedUser->user_type == env('ADMIN_ROLE_ID') ||
            $request->__authenticatedUser->user_type == env('SUPERADMIN_ROLE_ID')
        ) {
            $user = $request->__authenticatedUser;
            $user_type = $user->user_type;

            if ($user_type == env('ADMIN_ROLE_ID') ){
                $allJobs = $jobRepository->getAdminJobs();
            }
            if ($user_type == env('SUPERADMIN_ROLE_ID') ){
                $allJobs = $jobRepository->getSuperAdminJobs();
            }
            
            return ['alljobs' => $allJobs];
        }
    }

    public function validator(array $data)
    {
        $rules['from_language_id'] = 'required';

        if ($data['immediate'] == 'no') {
            $rules['due_date'] = 'required';
            $rules['due_time'] = 'required';
            $rules['customer_phone_type'] = 'required';
            $rules['duration'] = 'required';
        } else {
            $rules['duration'] = 'required';
        }

        $customMessages = [
            'required' => "Du måste fylla in alla fält"
        ];

        $this->validate($data, $rules, $customMessages);
    }

    public function bookingConfirmed($user_id)
    {
        $user = User::find($user_id);
        $user->job_id = '123';
        $user->notify(new BookingConfirmed());
    }
}
