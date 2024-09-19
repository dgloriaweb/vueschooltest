<?php

namespace App\MyClasses;

use App\Models\User;

class Functions
{
    public static function changeTimezone($randomuser)
    {
        $timezone = null;
        $tz = $randomuser->timezone;
        switch ($tz) {
            case ("GMT"):
                $timezone = "Europe/London";
                break;
            case ("CST"):
                $timezone = "America/Los_Angeles";
                break;
            case ("GMT+1"):
                $timezone = "America/Los_Angeles";
                break;
        }
        return $timezone;
    }
    public static function CreateUserJson()
    {
        // get all the users where the updated_at value is from the last 5 minutes
        // change it back after the test to 5 minutes
        // $updatedUsers = User::where('name', 'Wilbert Dach')->get(); --test 1
        // $updatedUsers = User::where('updated_at', '>', '2024-09-19 21:00:00')->get(); --test 2
        $dateInterval = (date('Y-m-d H:i:s', (strtotime('-5 minutes', strtotime(now())))));
        $updatedUsers = User::where('updated_at', '>', $dateInterval)->get();
        //define json
        $updateJson = ["batches"];
        // turn updaedusers into json
        foreach ($updatedUsers as $user) {
            // do the timezone conversion
            $transferredTimeZone = Functions::changeTimezone($user);
            
            if (isset($user->name) || isset($user->email)) {
                $updateJson["batches"][]["subscribers"][] =
                [
                    "name" => $user->name,
                    "email" => $user->email,
                    "timezone" => $transferredTimeZone
                ];
            }
        }
        // dd($updateJson);
        return $updateJson;
    }
}
