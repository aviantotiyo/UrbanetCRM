<?php

namespace App\Services;

use App\Libraries\RadiusClient\RadiusClient;

class RadiusAuthService
{
    protected $client;

    public function __construct()
    {
        $this->client = new RadiusClient(
            '127.0.0.1',     // IP RADIUS server kamu (WSL)
            'testing123',    // Shared secret
            1812,            // Port default
            3                // Timeout
        );
    }

    public function authenticate($username, $password)
    {
        return $this->client->authenticate($username, $password);
    }
}
