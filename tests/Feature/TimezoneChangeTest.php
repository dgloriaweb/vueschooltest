<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TimezoneChangeTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_we_change_timezone_for_api(): void
    {
        //get the timezone field from any user
        $randomUser = DB::table('users')
            ->inRandomOrder()
            ->first();
        //change the timezone to match the standard name
        $tzdata = $this->changeTimezone($randomuser);

        //assert that the field value is in the array of available names
        $tzarray = ["Europe/Amsterdam", "America/Los_Angeles", "Europe/London"];

        $this->assertContains($tzdata, $tzarray);
    }
    public function changeTimezone($randomuser)
    {
        $tz = $randomuser->timezone;
        switch ($tz) {
            case ("GMT"):
                "Europe/London";
                break;
            case ("CST"):
                "America/Los_Angeles";
                break;
            case ("GMT+1"):
                "America/Los_Angeles";
                break;
        }
    }
}
