<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $base;

    public function __construct()
    {
        $this->base = env('API_BASE_URL');
    }

    public function get(string $endpoint)
    {
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('API_TOKEN'),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ])
            ->acceptJson()
            ->asJson()
            ->timeout(30)
            ->retry(3, 200)
            ->get($this->base . $endpoint);

        if ($response->failed()) {
            throw new \Exception(
                "API request failed: {$endpoint} — " . $response->body()
            );
        }

        return $response->json();
    }

    public function post(string $endpoint, array $data)
    {
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('API_TOKEN'),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ])
            ->post(env('API_BASE_URL') . $endpoint, $data);

        if ($response->failed()) {
            throw new \Exception("POST failed: {$endpoint} — " . $response->body());
        }

        return $response->json();
    }

    public function put(string $endpoint, array $data)
    {
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('API_TOKEN'),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ])
            ->put(env('API_BASE_URL') . $endpoint, $data);

        if ($response->failed()) {
            throw new \Exception("PUT failed: {$endpoint} — " . $response->body());
        }

        return $response->json();
    }
}
