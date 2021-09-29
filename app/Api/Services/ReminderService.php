<?php

namespace App\Api\Services;

use App\Api\Model\Reminder;

use App\Repository\ReminderRepository;
use App\Api\ServiceImplementation\ReminderServiceInterface;
use Carbon\Carbon;

class ReminderService implements ReminderServiceInterface
{
    
    /**
     * @var $reminderRepo
     */
    public $reminderRepo;

    /**
     * @param ReminderRepository $repository
     */
    public function __construct(ReminderRepository $repository)
    {
        $this->reminderRepo = $repository;
    }

    /**
     *
     * @var App\Api\V4\Model\Reminders
     */
    protected $_RemindersModel = null;
    
     /**
     * @param array $request
     */
    public function addReminder(array $request)
    {
        $request['reminder_date'] = Carbon::parse($request['reminder_date'])->toDateString();
        return $this->reminderRepo->addReminder($request);
    }
    
    /**
      * Method to update reminder
     * @param array $request
     */
    public function updateReminder(int $id, array $request)
    {
        $request['reminder_date'] = Carbon::parse($request['reminder_date'])->toDateString();
        return $this->reminderRepo->updateReminder($id, $request);
    }

    /**
     * Method to get Reminder.
     * 
     * @return object $ReminderResponse
     */
    public function getReminders(array $request) {
        return $this->reminderRepo->getReminders($request);
    }

    /**
     * Method to delete Reminder.
     * 
     * @return object $ReminderResponse
     */
    public function deleteReminders(array $request) {
        return $this->reminderRepo->deleteReminders($request);
    }

}