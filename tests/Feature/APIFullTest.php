<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;
use App\MyClasses\Functions;
use Illuminate\Testing\TestResponse;

class APIFullTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $myJson = Functions::CreateUserJson();

        // Convert array to TestResponse
        $response = TestResponse::fromBaseResponse(response()->json($myJson));

        //asserting only for email because other data is not required   
        $response->assertJsonStructure([
            'batches' => [
                '*' => [ // wildcard to check each batch
                    'subscribers' => [
                        '*' => [ // wildcard to check each subscriber
                            'email' // check only for the email field
                        ],
                    ],
                ],
            ],
        ]);
    }
}
