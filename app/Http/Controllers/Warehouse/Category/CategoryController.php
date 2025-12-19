<?php

namespace App\Http\Controllers\Warehouse\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Warehouse\DataCategories;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DataCategories::latest()->get();
        return view('warehouse.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('warehouse.categories.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|string|unique:warehouse.data_categories,kode_kategori',
            'nama_kategori' => 'required|string',
            'deskripsi'     => 'nullable|string',
        ]);

        try {
            DataCategories::create([
                'id'            => Str::uuid(),
                'kode_kategori' => $request->kode_kategori,
                'nama_kategori' => $request->nama_kategori,
                'deskripsi'     => $request->deskripsi,
            ]);

            return redirect()->route('dashboard_category.index')
                ->with('success', 'Kategori berhasil ditambahkan.');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->withInput()->withErrors([
                    'kode_kategori' => 'Kode kategori sudah digunakan.'
                ]);
            }

            throw $e;
        }
    }

    public function edit($id)
    {
        $kategori = DataCategories::findOrFail($id);
        return view('warehouse.categories.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = DataCategories::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string',
            'deskripsi'     => 'nullable|string',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('dashboard_category.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }
}
