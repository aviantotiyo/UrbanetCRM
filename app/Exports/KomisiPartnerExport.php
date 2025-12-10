<?php

namespace App\Exports;

use App\Models\DataClientsPartner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KomisiPartnerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataClientsPartner::with(['partner', 'paket'])
            ->where('status', 'active')
            ->where('fee_paid', 0)
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Mitra'    => $item->partner->nama_partner ?? '-',
                    'Pelanggan'     => $item->nama ?? '-',
                    'No HP'         => $item->no_hp ?? '-',
                    'Alamat'        => $item->alamat ?? '-',
                    'Wilayah'       => "{$item->provinsi}/{$item->Kabupaten}/{$item->kecamatan}",
                    'Paket'         => $item->paket->nama_paket ?? '-',
                    'Harga Paket'   => $item->paket->harga ?? 0,
                    'Fee Komisi'    => $item->fee ?? 0,
                    'Tanggal Dibayar' => optional($item->fee_date_paid)->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Mitra',
            'Pelanggan',
            'No HP',
            'Alamat',
            'Wilayah',
            'Paket',
            'Harga Paket',
            'Fee Komisi',
            'Tanggal Dibayar',
        ];
    }
}
