<?php

namespace App\Exports;

use App\Models\DataClientsSales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KomisiSalesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return DataClientsSales::with(['user', 'paket'])
            ->where('status', 'active')
            ->where('fee_paid', 0)
            ->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->nama,
            optional($row->user)->name,
            optional($row->paket)->nama_paket,
            optional($row->paket)->harga,
            $row->fee,
            $row->fee_date_paid ? $row->fee_date_paid->format('Y-m-d H:i') : '-',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelanggan',
            'Nama Sales',
            'Paket',
            'Harga Paket',
            'Fee',
            'Tanggal Dibayar',
        ];
    }
}
