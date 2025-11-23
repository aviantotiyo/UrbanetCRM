<?php

namespace App\Services\Radius;

use Illuminate\Support\Facades\DB;

class RadiusUserRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = DB::connection('radius');
    }

    public function getUserByUsername($username)
    {
        return $this->connection->table('radcheck')
            ->where('username', $username)
            ->first();
    }

    public function createUser($username, $password)
    {
        $this->connection->table('radcheck')->insert([
            'username' => $username,
            'attribute' => 'Cleartext-Password',
            'op' => ':=',
            'value' => $password,
        ]);
    }

    public function deleteUser($username)
    {
        $this->connection->table('radcheck')->where('username', $username)->delete();
    }
}
