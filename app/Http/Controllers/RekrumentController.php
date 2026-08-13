<?php

namespace App\Http\Controllers;

use App\Models\Rekrument;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekrumentController extends Controller
{
    public function rekrutment()
    {
        $rekrutment = Rekrument::with(['lowongan'])->get();
        $lowongan = Lowongan::all();

        return view('rekrutment.rekrutment', compact('rekrutment', 'lowongan'));
    }

    public function create()
    {
        $lowongans = Lowongan::all();
        return view('rekrutment.create', compact('lowongans'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_lengkap'       => 'required|string|max:150',
            'email'              => 'required|email|max:100',
            'nomor_telepon'      => 'required|string|max:20',
            'alamat'             => 'required|string',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => 'required|string|max:20',
            'status_perkawinan'  => 'required|string|max:30',
            'jumlah_tanggungan'  => 'nullable|numeric',
            'gaji_terakhir'      => 'nullable|max:50',
            'gaji_harapan'       => 'required|max:50',
            'id_lowongan'        => 'required|exists:lowongans,id_lowongan', // Pastikan kolom ini sesuai DB
            'file_cv'            => 'required|file|max:2048',
            'file_ktp'           => 'required|file|max:2048',
            'file_surat_lamaran' => 'required|file|max:2048',
            'file_portofolio'    => 'nullable|file|max:2048',
        ]);

        // 2. Upload File
        $pathCv = $request->file('file_cv')->store('uploads/cv', 'public');
        $pathKtp = $request->file('file_ktp')->store('uploads/ktp', 'public');
        $pathSuratLamaran = $request->file('file_surat_lamaran')->store('uploads/surat_lamaran', 'public');

        $pathPortofolio = null;
        if ($request->hasFile('file_portofolio')) {
            $pathPortofolio = $request->file('file_portofolio')->store('uploads/portofolio', 'public');
        }

        // 3. Simpan Ke Database
        Rekrument::create([
            'nama_lengkap'       => $request->nama_lengkap,
            'email'              => $request->email,
            'nomor_telepon'      => $request->nomor_telepon,
            'alamat'             => $request->alamat,
            'tanggal_lahir'      => $request->tanggal_lahir,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'status_perkawinan'  => $request->status_perkawinan,
            'jumlah_tanggungan'  => $request->jumlah_tanggungan ?? 0,
            'gaji_terakhir'      => $request->gaji_terakhir,
            'gaji_harapan'       => $request->gaji_harapan,
            'id_lowongan'        => $request->id_lowongan,
            'file_cv'            => $pathCv,
            'file_ktp'           => $pathKtp,
            'file_surat_lamaran' => $pathSuratLamaran,
            'file_portofolio'    => $pathPortofolio,
            'status'             => 'Pending',
        ]);

        return redirect()->route('rekrutment')->with('success', 'Data lamaran berhasil dikirim');
    }

    public function edit(Rekrument $id)
    {
        $lowongans = Lowongan::all();
        return view('rekrutment.edit', compact('id', 'lowongans'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap'       => 'required|max:150',
            'email'              => 'required|email|max:100',
            'nomor_telepon'      => 'required|max:20',
            'alamat'             => 'required',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => 'required|max:20',
            'status_perkawinan'  => 'required|max:30',
            'jumlah_tanggungan'  => 'nullable|numeric',
            'gaji_terakhir'      => 'nullable|max:50',
            'gaji_harapan'       => 'required|max:50',
            'id_lowongan'        => 'required|exists:lowongans,id_lowongan',
            'status'             => 'required|max:50',
            'file_cv'            => 'nullable|file|max:5048', 
            'file_ktp'           => 'nullable|file|max:5048',
            'file_surat_lamaran' => 'nullable|file|max:5048',
            'file_portofolio'    => 'nullable|file|max:10240',
        ]);

        $rekrutment = Rekrument::findOrFail($id);

        $data = [
            'nama_lengkap'      => $request->nama_lengkap,
            'email'             => $request->email,
            'nomor_telepon'     => $request->nomor_telepon,
            'alamat'            => $request->alamat,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'status_perkawinan' => $request->status_perkawinan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'gaji_terakhir'     => $request->gaji_terakhir,
            'gaji_harapan'      => $request->gaji_harapan,
            'id_lowongan'       => $request->id_lowongan,
            'status'            => $request->status,
        ];

        if ($request->hasFile('file_cv')) {
            if ($rekrutment->file_cv) {
                Storage::disk('public')->delete($rekrutment->file_cv);
            }
            $data['file_cv'] = $request->file('file_cv')->store('uploads/cv', 'public');
        }

        if ($request->hasFile('file_ktp')) {
            if ($rekrutment->file_ktp) {
                Storage::disk('public')->delete($rekrutment->file_ktp);
            }
            $data['file_ktp'] = $request->file('file_ktp')->store('uploads/ktp', 'public');
        }

        if ($request->hasFile('file_surat_lamaran')) {
            if ($rekrutment->file_surat_lamaran) {
                Storage::disk('public')->delete($rekrutment->file_surat_lamaran);
            }
            $data['file_surat_lamaran'] = $request->file('file_surat_lamaran')->store('uploads/surat_lamaran', 'public');
        }

        if ($request->hasFile('file_portofolio')) {
            if ($rekrutment->file_portofolio) {
                Storage::disk('public')->delete($rekrutment->file_portofolio);
            }
            $data['file_portofolio'] = $request->file('file_portofolio')->store('uploads/portofolio', 'public');
        }

        $rekrutment->update($data);

        return redirect()->route('rekrutment')->with('success', 'Data rekrutmen berhasil diperbarui');
    }

    public function updateLowongan(Request $request, string $id)
    {
        $request->validate([
            'id_lowongan' => 'required|exists:lowongans,id_lowongan', // Disesuaikan dari 'id' ke 'id_lowongan'
        ]);

        $rekrutment = Rekrument::findOrFail($id);
        $rekrutment->update([
            'id_lowongan' => $request->id_lowongan
        ]);

        return redirect()->back()->with('success', 'Lowongan pelamar berhasil diperbarui');
    }

    public function delete(Rekrument $id)
    {
        if ($id->file_cv) {
            Storage::disk('public')->delete($id->file_cv);
        }
        if ($id->file_ktp) {
            Storage::disk('public')->delete($id->file_ktp);
        }
        if ($id->file_surat_lamaran) {
            Storage::disk('public')->delete($id->file_surat_lamaran);
        }
        if ($id->file_portofolio) {
            Storage::disk('public')->delete($id->file_portofolio);
        }

        $id->delete();

        return redirect()->route('rekrutment')->with('success', 'Data berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Seleksi Berkas,Wawancara,Diterima,Ditolak',
        ]);

        $rekrutment = Rekrument::findOrFail($id);
        $rekrutment->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui menjadi ' . $request->status);
    }
}
