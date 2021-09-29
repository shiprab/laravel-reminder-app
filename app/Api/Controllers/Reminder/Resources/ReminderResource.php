<?php

namespace App\Api\Controllers\Reminder\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class ReminderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'reminder_date' => Carbon::parse($this->reminder_date)->format('d-m-Y'),
            'description' => $this->description,
            'status' => $this->status
        ];
    }
}