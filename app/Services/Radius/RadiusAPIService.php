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

    public function createGroup(string $groupname, string $rateLimit, string $ipPool)
    {
        $payload = [
            'groupname' => $groupname,
            'check' => [
                [
                    'attribute' => 'Auth-Type',
                    'op' => ':=',
                    'value' => 'Accept'
                ]
            ],
            'reply' => [
                [
                    'attribute' => 'Mikrotik-Rate-Limit',
                    'op' => '=',
                    'value' => $rateLimit
                ],
                [
                    'attribute' => 'Framed-Pool',
                    'op' => '=',
                    'value' => $ipPool
                ]
            ]
        ];


        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post("{$this->baseUrl}/api/groups", $payload)->json();
    }

    public function updateGroup(string $groupname, string $rateLimit, string $ipPool)
    {
        $payload = [
            'check' => [
                [
                    'attribute' => 'Auth-Type',
                    'op' => ':=',
                    'value' => 'Accept'
                ]
            ],
            'reply' => [
                [
                    'attribute' => 'Mikrotik-Rate-Limit',
                    'op' => '=',
                    'value' => $rateLimit
                ],
                [
                    'attribute' => 'Framed-Pool',
                    'op' => '=',
                    'value' => $ipPool
                ]
            ]
        ];


        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->put("{$this->baseUrl}/api/groups/{$groupname}", $payload)->json();
    }
}
