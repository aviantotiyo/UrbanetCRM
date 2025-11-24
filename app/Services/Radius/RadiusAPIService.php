<?php

namespace App\Services\Radius;

use Illuminate\Support\Facades\Http;

class RadiusAPIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('radius.base_url'), '/');
        $this->apiKey  = config('radius.api_key');
    }

    protected function request(string $method, string $endpoint, array $payload = [])
    {
        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->send($method, $this->baseUrl . $endpoint, ['json' => $payload])->json();
    }

    public function getAllUsers()
    {
        return $this->request('GET', '/api/users');
    }

    public function createUser(array $data)
    {
        return $this->request('POST', '/api/users', $data);
    }

    public function deleteUser(string $username)
    {
        return $this->request('DELETE', "/api/users/{$username}");
    }

    public function createGroup(string $groupname, string $rateLimit, string $ipPool)
    {
        $payload = [
            'groupname' => $groupname,
            'check' => [
                ['attribute' => 'Auth-Type', 'op' => ':=', 'value' => 'Accept']
            ],
            'reply' => [
                ['attribute' => 'Mikrotik-Rate-Limit', 'op' => '=', 'value' => $rateLimit],
                ['attribute' => 'Framed-Pool', 'op' => '=', 'value' => $ipPool]
            ]
        ];

        return $this->request('POST', '/api/groups', $payload);
    }

    public function updateGroup(string $groupname, string $rateLimit, string $ipPool)
    {
        $payload = [
            'check' => [
                ['attribute' => 'Auth-Type', 'op' => ':=', 'value' => 'Accept']
            ],
            'reply' => [
                ['attribute' => 'Mikrotik-Rate-Limit', 'op' => '=', 'value' => $rateLimit],
                ['attribute' => 'Framed-Pool', 'op' => '=', 'value' => $ipPool]
            ]
        ];

        return $this->request('PUT', "/api/groups/{$groupname}", $payload);
    }

    public function assignUserToGroup(string $username, string $groupname)
    {
        return $this->request('POST', '/api/user-group', [
            'username' => $username,
            'groupname' => $groupname,
        ]);
    }
}
