<?php

namespace App\Services\Radius;

use Illuminate\Support\Facades\Http;

class RadiusAPIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('radius.base_url');
        $this->apiKey  = config('radius.api_key');
    }

    public function getAllUsers()
    {
        return Http::withToken($this->apiKey)->get("{$this->baseUrl}/api/users")->json();
    }

    public function createUser(array $data)
    {
        return Http::withToken($this->apiKey)->post("{$this->baseUrl}/api/users", $data)->json();
    }

    public function deleteUser(string $username)
    {
        return Http::withToken($this->apiKey)->delete("{$this->baseUrl}/api/users/{$username}")->json();
    }
}
