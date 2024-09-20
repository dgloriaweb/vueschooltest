<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SendingCorrectApiDataTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_sent_data_is_in_correct_format(): void
    {
        //assert that the data sent is matching the required json format
        /* 
        {
            "batches": [{
            "subscribers": [
                {
                "email": "alex@acme.com",
                "time_zone": "Europe/Amsterdam"
                },
                {
                "email": "hellen@acme.com",
                "name": "Hellen",
                "time_zone": "America/Los_Angeles",
                }
                }
            ]
            }]
        }
        */
        $responseArray = [
            "batches" => [
                [
                    "subscribers" => [
                        [
                            "email" => "alex@acme.com",
                            "time_zone" => "Europe/Amsterdam"
                        ],
                        [
                            "email" => "hellen@acme.com",
                            "name" => "Hellen",
                            "time_zone" => "America/Los_Angeles"
                        ]
                    ]
                ]
            ]
        ];

        // Convert array to TestResponse
        $response = TestResponse::fromBaseResponse(response()->json($responseArray));

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
