<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    // 1. Menampilkan daftar semua lowongan
    public function lowongan()
    {
        $lowongan = Lowongan::all();
        return view('lowongan.lowongan', compact('lowongan'));
    }

    // 2. Menampilkan form tambah lowongan
    public function create()
    {
        return view('lowongan.create');
    }

    // 3. Menyimpan data lowongan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lowongan'    => 'required|max:150',
            'jumlah_kebutuhan' => 'required|numeric|min:1',
        ]);

        Lowongan::create([
            'nama_lowongan'    => $request->nama_lowongan,
            'jumlah_kebutuhan' => $request->jumlah_kebutuhan,
        ]);

        return redirect()->route('lowongan')->with('success', 'Data lowongan berhasil ditambahkan');
    }

    // 4. Menampilkan form edit lowongan
    public function edit(string $id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('lowongan.edit', compact('lowongan'));
    }

    // 5. Mengubah data lowongan di database
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lowongan'    => 'required|max:150',
            'jumlah_kebutuhan' => 'required|numeric|min:1',
        ]);

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update([
            'nama_lowongan'    => $request->nama_lowongan,
            'jumlah_kebutuhan' => $request->jumlah_kebutuhan,
        ]);

        return redirect()->route('lowongan')->with('success', 'Data lowongan berhasil diperbarui');
    }

    // 6. Menghapus lowongan
    public function destroy(string $id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('lowongan')->with('success', 'Data lowongan berhasil dihapus');
    }
}