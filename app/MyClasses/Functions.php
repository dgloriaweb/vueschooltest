<?php

namespace App\MyClasses;

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
}
