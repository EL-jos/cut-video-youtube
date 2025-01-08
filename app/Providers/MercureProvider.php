<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MercureProvider extends ServiceProvider
{
    public $jwtKey;
    public function __construct()
    {
        $this->jwtKey = env('JWT_KEY');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function post(string $topic, array $data)
    {

        $postData = http_build_query([
            'topic' => $topic,
            'data' => json_encode($data)
        ]);

        echo file_get_contents(env('MERCURE_URL'), false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Bearer " . $this->jwtKey . "\r\n",
                'content' => $postData
            ]
        ]));
    }
}
