<?php

namespace App\Http\Controllers\Warehouse\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Warehouse\DataItems;
use App\Models\Warehouse\DataCategories;
use Illuminate\Database\QueryException;

class ItemsController extends Controller
{
    public function index()
    {
        $items = DataItems::with('category')->latest()->paginate(15);

        return view('warehouse.items.index', compact('items'));
    }

    public function create()
    {
        $categories = DataCategories::orderBy('nama_kategori')->get();
        return view('warehouse.items.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'   => 'required|string',
            'category_id'   => 'required|exists:warehouse.data_categories,id',
            'unit_type'     => 'required|in:unit,roll,meter,lainnya',
            'spesifikasi'   => 'nullable|string',
            'barcode'       => 'nullable|string',
            'harga_satuan'  => 'nullable|integer',
            'img'           => 'nullable|string',
            'kode_barang'   => 'nullable|string|unique:warehouse.data_items,kode_barang',
        ]);

        DataItems::create([
            'id'            => Str::uuid(),
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'category_id'   => $request->category_id,
            'unit_type'     => $request->unit_type,
            'spesifikasi'   => $request->spesifikasi,
            'barcode'       => $request->barcode,
            'harga_satuan'  => $request->harga_satuan,
            'img'           => $request->img,
        ]);

        return redirect()->route('admin.warehouse_items.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = DataItems::findOrFail($id);
        $categories = DataCategories::orderBy('nama_kategori')->get();

        return view('warehouse.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = DataItems::findOrFail($id);

        $request->validate([
            'nama_barang'   => 'required|string',
            'category_id'   => 'required|exists:data_categories,id',
            'unit_type'     => 'required|in:unit,roll,meter,lainnya',
            'spesifikasi'   => 'nullable|string',
            'barcode'       => 'nullable|string',
            'harga_satuan'  => 'nullable|integer',
            'img'           => 'nullable|string',
        ]);

        $item->update([
            'nama_barang'   => $request->nama_barang,
            'category_id'   => $request->category_id,
            'unit_type'     => $request->unit_type,
            'spesifikasi'   => $request->spesifikasi,
            'barcode'       => $request->barcode,
            'harga_satuan'  => $request->harga_satuan,
            'img'           => $request->img,
        ]);

        return redirect()->route('admin.warehouse_items.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }
}
