<?php

namespace App\Http\Controllers\Warehouse\DataWarehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Warehouse\DataWarehouse;
use Illuminate\Database\QueryException;

class DataWarehouseController extends Controller
{
    public function index()
    {
        $warehouses = DataWarehouse::latest()->get();
        return view('warehouse.warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouse.warehouse.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_gudang' => 'required|string',
            'nama_gudang' => 'required|string',
            'lokasi'      => 'nullable|string',
            'jenis'       => 'required|in:internal,personal',
        ]);

        try {
            DataWarehouse::create([
                'id'          => Str::uuid(),
                'kode_gudang' => $request->kode_gudang,
                'nama_gudang' => $request->nama_gudang,
                'lokasi'      => $request->lokasi,
                'jenis'       => $request->jenis,
            ]);
        } catch (QueryException $e) {

            // MySQL duplicate entry error code
            if ($e->errorInfo[1] == 1062) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'kode_gudang' => 'Kode gudang sudah digunakan, silakan gunakan kode lain.'
                    ]);
            }

            // error lain (biar tetap kelihatan saat debugging)
            throw $e;
        }

        return redirect()
            ->route('admin.dashboard_warehouse.index')
            ->with('success', 'Gudang berhasil ditambahkan');
    }


    public function edit($id)
    {
        $gudang = DataWarehouse::findOrFail($id);
        return view('warehouse.warehouse.edit', compact('gudang'));
    }

    public function update(Request $request, $id)
    {
        $gudang = DataWarehouse::findOrFail($id);

        $request->validate([
            'kode_gudang' => 'required|string|unique:warehouse.data_warehouses,kode_gudang,' . $gudang->id . ',id',
            'nama_gudang' => 'required|string',
            'lokasi'      => 'nullable|string',
            'jenis'       => 'required|in:internal,personal',
        ]);

        $gudang->update([
            'kode_gudang' => $request->kode_gudang,
            'nama_gudang' => $request->nama_gudang,
            'lokasi'      => $request->lokasi,
            'jenis'       => $request->jenis,
        ]);

        return redirect()->route('admin.dashboard_warehouse.index')->with('success', 'Data gudang berhasil diperbarui.');
    }
}
