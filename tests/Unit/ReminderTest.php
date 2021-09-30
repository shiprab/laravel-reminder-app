<?php

namespace Tests\Unit;

use App\Models\Reminder;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ReminderTest extends TestCase
{
    use WithoutMiddleware;
    //@TODO improvement in test coverage
    /**
     * A basic unit test to create a reminder.
     *
     * @return void
     */
    public function test_can_create_reminder()
    {
        $reminder = Reminder::factory()->create();
        $this->assertModelExists($reminder);
    }
    /**
     * A basic unit test to update a reminder.
     *
     * @return void
     */
    public function test_can_update_reminder()
    {

        $reminder = Reminder::factory()->create();
        $data = [
            'description' => "update to this",
            'reminder_date' => '2021-12-08',
        ];

        $this->put(route('reminders.update', $reminder->id), $data);
        $res_array = (array) json_decode($reminder);
        $this->assertArrayHasKey('id', $res_array);
    }
    /**
     * A basic unit test to list of reminders.
     *
     * @return void
     */
    public function test_can_show_reminder()
    {

        $reminder = Reminder::factory()->create();

        $this->get(route('reminders.show', $reminder->id))
            ->assertStatus(200);
    }
    /**
     * A basic unit test to delete a reminder.
     *
     * @return void
     */
    public function test_can_delete_reminder()
    {

        $reminder = Reminder::factory()->create();

        $this->delete(route('reminders.delete', $reminder->id))
            ->assertStatus(200);
    }

}
