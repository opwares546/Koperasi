<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        $simpanan = Simpanan::with(['anggota', 'petugas'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('anggota', function ($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('no_anggota', 'like', "%{$request->search}%");
                });
            })
            ->latest('tanggal_transaksi')
            ->paginate(10)
            ->withQueryString();

        return view('simpanan.index', compact('simpanan'));
    }

    public function create()
    {
        // Ambil data anggota yang aktif saja untuk dipilih di form
        $anggota = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        return view('simpanan.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal_transaksi' => ['required', 'date'],
            'jenis_simpanan' => ['required', Rule::in(['pokok', 'wajib', 'sukarela'])],
            'jumlah' => ['required', 'numeric', 'min:1000'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        // Tambahkan ID user (petugas) yang sedang login
        $data['user_id'] = auth()->id();

        Simpanan::create($data);

        return redirect()->route('simpanan.index')->with('success', 'Transaksi simpanan berhasil dicatat.');
    }

    public function show(Simpanan $simpanan)
    {
        // Jika butuh halaman detail khusus
        return view('simpanan.show', compact('simpanan'));
    }

    public function edit(Simpanan $simpanan)
    {
        $anggota = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        return view('simpanan.edit', compact('simpanan', 'anggota'));
    }

    public function update(Request $request, Simpanan $simpanan)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal_transaksi' => ['required', 'date'],
            'jenis_simpanan' => ['required', Rule::in(['pokok', 'wajib', 'sukarela'])],
            'jumlah' => ['required', 'numeric', 'min:1000'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $simpanan->update($data);

        return redirect()->route('simpanan.index')->with('success', 'Transaksi simpanan berhasil diperbarui.');
    }

    public function destroy(Simpanan $simpanan)
    {
        $simpanan->delete();
        return redirect()->route('simpanan.index')->with('success', 'Transaksi simpanan berhasil dibatalkan/dihapus.');
    }
}