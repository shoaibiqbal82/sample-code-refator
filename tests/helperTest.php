<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testWillExpireAt()
    {
        // helper function looks like passes only 2 condition les than 90 and greter than 90
        // if its the intended functionality then we can write test for thes 2 conditions.

        $this->assertEquals(willExpireAt('2023-04-30 01:00:00', '2023-04-30 23:00:00'), '2023-04-30 01:00:00');

        $this->assertEquals(willExpireAt('2023-04-30 01:00:00', '2023-04-25 23:00:00'), '2023-04-28 01:00:00');
    }
}
