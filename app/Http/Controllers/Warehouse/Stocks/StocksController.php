<?php

namespace App\Http\Controllers\Warehouse\Stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Warehouse\DataWarehouseStocks;
use App\Models\Warehouse\DataItems;
use App\Models\Warehouse\DataCategories;
use App\Models\Warehouse\DataWarehouse;
use Illuminate\Support\Facades\Session;

class StocksController extends Controller
{
    public function index(Request $request)
    {
        $query = DataWarehouseStocks::with(['item', 'category', 'warehouse']);

        // Filter by warehouse
        if ($request->filled('warehouse_id')) {
            $query->where('warehouse_id', $request->warehouse_id);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search by item name
        if ($request->filled('search')) {
            $query->whereHas('item', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $stocks = $query->latest()->paginate(10)->withQueryString();
        $warehouses = DataWarehouse::orderBy('nama_gudang')->get();
        $categories = DataCategories::orderBy('nama_kategori')->get();

        return view('warehouse.stocks.index', compact('stocks', 'warehouses', 'categories'));
    }


    public function create()
    {
        $warehouses = DataWarehouse::orderBy('nama_gudang')->get();
        $items = DataItems::orderBy('nama_barang')->get();
        $categories = DataCategories::orderBy('nama_kategori')->get();

        return view('warehouse.stocks.add', compact('warehouses', 'items', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'warehouse_id'  => 'required|exists:warehouse.data_warehouses,id',
            'item_id'       => 'required|exists:warehouse.data_items,id',
            'category_id'   => 'required|exists:warehouse.data_categories,id',
            'jumlah'        => 'required|integer',
            'kode_rak'      => 'nullable|string|max:255',
        ]);

        // Validasi jumlah
        if ($request->jumlah <= 0) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'jumlah' => 'Jumlah stok harus lebih dari 0.'
                ]);
        }

        // Cek duplikat kombinasi
        $exists = DataWarehouseStocks::where('warehouse_id', $request->warehouse_id)
            ->where('item_id', $request->item_id)
            ->where('category_id', $request->category_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'duplicate' => 'Stok dengan kombinasi gudang, item, dan kategori ini sudah ada.'
                ]);
        }

        DataWarehouseStocks::create([
            'id'            => Str::uuid(),
            'warehouse_id'  => $request->warehouse_id,
            'item_id'       => $request->item_id,
            'category_id'   => $request->category_id,
            'jumlah'        => $request->jumlah,
            'kode_rak'      => $request->kode_rak,
        ]);

        return redirect()
            ->route('admin.warehouse_stocks.index')
            ->with('success', 'Data stok berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $stock = DataWarehouseStocks::findOrFail($id);
        $warehouses = DataWarehouse::orderBy('nama_gudang')->get();
        $items = DataItems::orderBy('nama_barang')->get();
        $categories = DataCategories::orderBy('nama_kategori')->get();

        return view('warehouse.stocks.edit', compact('stock', 'warehouses', 'items', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $stock = DataWarehouseStocks::findOrFail($id);

        $request->validate([
            'warehouse_id'   => 'required|exists:warehouse.data_warehouses,id',
            'item_id'        => 'required|exists:warehouse.data_items,id',
            'category_id'    => 'required|exists:warehouse.data_categories,id',
            'jumlah_tambah'  => 'nullable|integer|min:1',
            'kode_rak'       => 'nullable|string|max:255',
        ]);

        // HITUNG DI SERVER (AMAN)
        $jumlahBaru = $stock->jumlah + $request->jumlah_tambah;

        $stock->update([
            'jumlah'   => $jumlahBaru,
            'kode_rak' => $request->kode_rak,
        ]);

        return redirect()
            ->route('admin.warehouse_stocks.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }


    public function delete($id)
    {
        $stock = DataWarehouseStocks::findOrFail($id);
        $stock->delete();

        return redirect()
            ->route('admin.warehouse_stocks.index')
            ->with('success', 'Data stok berhasil dihapus.');
    }
}
