<?php

namespace Tests\Unit;

use App\Task;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetTitleReturnsNullIfUndefined()
    {
        $task = new Task;

        $this->assertNull($task->getTitle());
    }

    public function testGetTitleReturnsTitle()
    {
        $task = new Task;
        $task->title = 'This is a test';

        $this->assertEquals(
            'This is a test',
            $task->getTitle()
        );
    }

    public function testGetDescriptionReturnsNullIfUndefined()
    {
        $task = new Task;

        $this->assertNull($task->getDescription());
    }

    public function testGetDescriptionReturnsDescription()
    {
        $task = new Task;
        $task->description = 'This is a test';

        $this->assertEquals(
            'This is a test',
            $task->getDescription()
        );
    }

    public function testGetCreatedAtReturnsCarbonObject()
    {
        $task = factory(\App\Task::class)->make();

        $this->assertInstanceOf(Carbon::class, $task->getCreatedAt());
    }

    public function testToggle()
    {
        $contact = factory(\App\Contact::class)->create();

        $task = factory(\App\Task::class)->make([
            'contact_id' => $contact->id,
            'status' => 'inprogress',
        ]);

        $this->assertEquals(
            'inprogress',
            $task->status
        );

        $task->toggle();

        $this->assertEquals(
            'completed',
            $task->status
        );

        $task->toggle();

        $this->assertEquals(
            'inprogress',
            $task->status
        );
    }
}
