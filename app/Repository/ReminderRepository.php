<?php

namespace App\Repository;

use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

/**
 * Reminder Repository houses all the queries to interact with the model
 *
 * Class ReminderRepository
 * @package App\Repository
 */
class ReminderRepository
{
    /**
     * @var $reminderModel
     */
    public $reminderModel;

    /**
     * @param Reminder $reminder
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminderModel = $reminder;
    }

    /**
     * @param $request
     */
    public function addReminder($request)
    {
        try {
            return $this->reminderModel->query()->create($request);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([trans('custom.failure')]);
        }
    }

    /**
     * @param int $id
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @throws ValidationException
     */
    public function updateReminder(int $id, array $request)
    {
        try {

            return $this->reminderModel->query()->where('id', $id)->update($request);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([trans('custom.failure')]);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws ValidationException
     */
    public function getReminders($request)
    {
        try {
            $reminder = $this->reminderModel->query();
            if (isset($request['reminder_date']) && $request['reminder_date'] != null) {
                $reminder = $reminder->where('reminder_date', '=', Carbon::parse($request['reminder_date'])->toDateString());
            } else {
                $reminder = $reminder->where('reminder_date', '>', Carbon::now()->toDateString());
            }
            if (isset($request['status']) && $request['status'] != null) {
                $reminder = $reminder->where('status', '=', $request['status']);
            }

            return $reminder->whereNull('deleted_at')->get();

        } catch (\Exception $e) {
            throw ValidationException::withMessages([trans('custom.failure')]);
        }
    }
    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws ValidationException
     */
    public function deleteReminders($request)
    {
        try {
            $deleteFlag = 0;
            $reminder = $this->reminderModel->query();
            if (isset($request['id']) && $request['id'] != null) {
                $reminder = $reminder->where('id', '=', $request['id']);
                $deleteFlag = 1;
            }
            if (isset($request['reminder_date']) && $request['reminder_date'] != null) {
                $reminder = $reminder->where('reminder_date', '=', Carbon::parse($request['reminder_date'])->toDateString());
                $deleteFlag = 1;
            }
            if (isset($request['status']) && $request['status'] != null) {
                $reminder = $reminder->where('status', '=', $request['status']);
                $deleteFlag = 1;
            }
            if ($deleteFlag == 1) {
                return $reminder->delete();
            }

        } catch (\Exception $e) {
            throw ValidationException::withMessages([trans('custom.failure')]);
        }
    }
}
