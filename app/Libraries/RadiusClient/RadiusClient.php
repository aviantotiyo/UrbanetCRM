<?php

namespace App\Libraries\RadiusClient;

class RadiusClient
{
    protected $host;
    protected $secret;
    protected $port;
    protected $timeout;

    public function __construct($host, $secret, $port = 1812, $timeout = 3)
    {
        $this->host = '192.168.1.14';
        $this->secret = $secret;
        $this->port = $port;
        $this->timeout = $timeout;
    }

    public function authenticate($username, $password)
    {
        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, [
            "sec" => $this->timeout,
            "usec" => 0
        ]);

        $identifier = random_int(0, 255);
        $authenticator = random_bytes(16);

        $attrs = $this->buildAttributes([
            1 => $username, // User-Name
            2 => $password  // User-Password (plaintext, akan dienkripsi)
        ], $authenticator);

        $code = chr(1); // Access-Request
        $length = 20 + strlen($attrs);
        $packet = $code . chr($identifier) . pack('n', $length) . $authenticator . $attrs;

        $packet = $this->addMessageAuthenticator($packet);

        socket_sendto($socket, $packet, strlen($packet), 0, $this->host, $this->port);

        $response = '';
        $from = '';
        $port = 0;

        if (@socket_recvfrom($socket, $response, 4096, 0, $from, $port) !== false) {
            $response_code = ord($response[0]);
            socket_close($socket);
            return $response_code === 2; // Access-Accept = 2
        }

        socket_close($socket);
        return false;
    }

    protected function buildAttributes($attributes, $authenticator)
    {
        $data = '';
        foreach ($attributes as $type => $value) {
            if ($type == 2) {
                // Encrypt User-Password
                $value = $this->encryptPassword($value, $authenticator);
            }
            $len = strlen($value) + 2;
            $data .= chr($type) . chr($len) . $value;
        }
        return $data;
    }

    protected function encryptPassword($password, $authenticator)
    {
        $password = str_pad($password, ceil(strlen($password) / 16) * 16, "\0");
        $b1 = md5($this->secret . $authenticator, true);
        $res = $this->xor16(substr($password, 0, 16), $b1);

        for ($i = 1; $i < strlen($password) / 16; $i++) {
            $bi = md5($this->secret . substr($res, ($i - 1) * 16, 16), true);
            $res .= $this->xor16(substr($password, $i * 16, 16), $bi);
        }

        return $res;
    }

    protected function xor16($a, $b)
    {
        return $a ^ $b;
    }

    protected function addMessageAuthenticator($packet)
    {
        // Optional: skip for now
        return $packet;
    }
}
