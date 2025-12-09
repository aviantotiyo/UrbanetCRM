<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KomisiTeknisiExport implements FromCollection, WithHeadings
{
    protected $rows;

    public function __construct(Collection $rows)
    {
        $this->rows = $rows;
    }

    public function collection()
    {
        return $this->rows->map(function ($row) {
            return [
                $row['user']->name ?? '-',
                $row['user']->role ?? '-',
                $row['ticketHC']->ticket_code ?? '-',
                $row['ticket']->ticket_code ?? '-',
                $row['client']->nama ?? '-',
                $row['client']->nopel ?? '-',
                $row['fee'],
                \Carbon\Carbon::parse($row['updated_at'])->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Teknisi',
            'Role',
            'Instalasi',
            'Perbaikan',
            'Nama Pelanggan',
            'No Pelanggan',
            'Fee (Rp)',
            'Tanggal Update',
        ];
    }
}
