<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UpdateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get a random user using inRandomOrder and first
        $randomUser = User::inRandomOrder()->first();

        if ($randomUser) {
            $randomUser->name = 'Paul McCartney';
            $randomUser->save();

            $this->info('Random user updated successfully.');
        } else {
            $this->error('No users found in the database.');
        }
    }
}
