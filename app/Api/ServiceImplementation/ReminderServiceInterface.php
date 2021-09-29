<?php

namespace App\Api\ServiceImplementation;

Interface ReminderServiceInterface
{

    /**
     * Method to Add Reminder.
     * 
     * @return object $ReminderResponse
     */
    public function addReminder(array $request);

    /**
     * Method to update Reminder.
     * 
     * @return object $ReminderResponse
     */
    public function updateReminder(int $id, array $request);

    /**
     * Method to get Reminder.
     * 
     * @return object $ReminderResponse
     */
    public function getReminders(array $request);

    /**
     * Method to delete Reminder.
     * 
     * @return object $ReminderResponse
     */
    public function deleteReminders(array $request);

}
