<?php

namespace App\Http\Controllers\Radius;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Radius\RadiusService;

class RadiusTestController extends Controller
{
    protected $radius;

    public function __construct(RadiusService $radius)
    {
        $this->radius = $radius;
    }

    public function test()
    {
        $response = $this->radius->registerUser('testuser', 'password123');
        return response()->json(['status' => $response]);
    }
}
