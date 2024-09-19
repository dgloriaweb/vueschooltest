<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;
use App\MyClasses\Functions;

class APIFullTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // get all the users where the updated_at value is from the last 5 minutes
        // change it back after the test to 5 minutes
        // $updatedUsers = User::where('name', 'Wilbert Dach')->get(); --test 1
        // $updatedUsers = User::where('updated_at', '>', '2024-09-19 21:00:00')->get(); --test 2
        $dateInterval = (date('Y-m-d H:i:s', (strtotime('-55 minutes', strtotime(now())))));
        $updatedUsers = User::where('updated_at', '>', $dateInterval)->get();
        //define json
        $updateJson = null;
        // turn updaedusers into json
        foreach ($updatedUsers as $user) {
            // do the timezone conversion
            $transferredTimeZone = Functions::changeTimezone($user);

            if (isset($user->name) || isset($user->email)) {
                $updateJson["batches"]["subscribers"] = [
                    "name" => $user->name,
                    "email" => $user->email,
                    "timezone" => $transferredTimeZone
                ];
            }
        }
        dd($updateJson);


        // $response->assertStatus(200);
    }
}
