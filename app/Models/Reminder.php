<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reminder
 * @package App\Models
 */
class Reminder extends Model
{
    use HasTimestamps, SoftDeletes;

    public $table = 'reminders';
    public $fillable = [
        'description',
        'reminder_date',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}