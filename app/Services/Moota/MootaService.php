<?php

// app/Services/MootaService.php
namespace App\Services\Moota;

use Illuminate\Support\Facades\Http;

class MootaService
{
    public function fetchMutasi($startDate, $endDate, $perPage = 50)
    {
        $response = Http::withToken(config('moota.token'))
            ->acceptJson()
            ->get('https://api.moota.co/api/v2/mutation', [
                'type' => 'CR',
                'bank' => config('moota.bank_id'),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'page' => 1,
                'per_page' => $perPage,
            ]);

        if (!$response->successful()) {
            throw new \Exception("Gagal mengambil mutasi dari Moota API.");
        }

        return $response->json()['data'] ?? [];
    }
}
