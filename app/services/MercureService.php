<?php

namespace App\Services;

class MercureService
{
    protected $mercureUrl;
    protected $jwtKey;

    public function __construct()
    {
        $this->mercureUrl = env('MERCURE_URL');
        $this->jwtKey = env('JWT_KEY');
    }

    public function post(string $topic, array $data)
    {
        $postData = http_build_query([
            'topic' => $topic,
            'data' => json_encode($data)
        ]);

        $response = file_get_contents($this->mercureUrl, false, stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Bearer " . $this->jwtKey . "\r\n",
                'content' => $postData
            ]
        ]));

        return $response;
    }
}
