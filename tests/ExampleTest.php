<?php

namespace SuperStation\Gamehub\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends BaseTestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        dd('here');
        $this->assertTrue(true);
    }
}
