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
    protected $signature = 'app:update-user';

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
        //
        $randomUser = DB::table('users')
            ->inRandomOrder()
            ->first();

        $randomUser->name = 'Paul McCartney';
        $randomUser->save();

        // User::all()->each(function ($user) use ($faker) {
        //     $user->name = $faker->name;
        //     $user->save();
        // });

    }
}
