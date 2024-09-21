<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Http;

use function Laravel\Prompts\error;

class ProcessApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $userJson;
    /**
     * Create a new job instance.
     */
    public function __construct(array $userJson)
    {
        $this->userJson = $userJson;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // // job is to send the api request to the queue                     --this would be your normal API call

        // $url = "your api endpoint url";

        // // Send POST request to the API with the user data
        // $response = Http::post($url, $this->userJson);
        // // Check if the request was successful
        // if ($response->successful()) {
        //     info('User data successfully sent to API.', $this->userJson);
        // } else {
        //     error('Failed to send user data to API.', [
        //         'status' => $response->status(),
        //         'response' => $response->body(),
        //     ]);
        // }

        info('Processed user data: ');
        foreach ($this->userJson['batches'][0]['subscribers'] as $data) {
            info('{name} {timezone}', ['name' => $data['name']], ['timezone' => $data['timezone']]);
        }
    }
}
