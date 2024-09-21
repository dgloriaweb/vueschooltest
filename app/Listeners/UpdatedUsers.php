<?php

namespace App\Listeners;

use App\Events\WatchUser;
use App\Jobs\ProcessApi;
use App\MyClasses\Functions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatedUsers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WatchUser $event): void
    {
        // here we can send the api call with the user that has been updated
        try {

            $userJson = Functions::CreateUpdatedUserJson($event->updatedUser);
            if($userJson) {
                // store the data in the jobs table
                ProcessApi::dispatch($userJson);
            }
        } catch (\Exception $ex) {
            info('error in the api prepare, ' . $ex);
        }
        // dd($event);
        info('we have sent the api call with data of ' . $event->updatedUser->name);
    }
}
