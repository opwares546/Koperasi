<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PinjamanController extends Controller
{
    public function index(Request $request)
    {
        $pinjaman = Pinjaman::with(['anggota', 'petugas'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('anggota', function ($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('no_anggota', 'like', "%{$request->search}%");
                });
            })
            ->latest('tanggal_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view('pinjaman.index', compact('pinjaman'));
    }

    public function create()
    {
        $anggota = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        return view('pinjaman.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal_pinjam' => ['required', 'date'],
            'jumlah' => ['required', 'numeric', 'min:50000'],
            'lama_angsuran' => ['required', 'integer', 'min:1', 'max:60'], // dalam bulan
            'bunga' => ['required', 'numeric', 'min:0'], // persen
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'belum_lunas';

        Pinjaman::create($data);

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil dicatat.');
    }

    public function show(Pinjaman $pinjaman)
    {
        return view('pinjaman.show', compact('pinjaman'));
    }

    public function edit(Pinjaman $pinjaman)
    {
        $anggota = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        return view('pinjaman.edit', compact('pinjaman', 'anggota'));
    }

    public function update(Request $request, Pinjaman $pinjaman)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal_pinjam' => ['required', 'date'],
            'jumlah' => ['required', 'numeric', 'min:50000'],
            'lama_angsuran' => ['required', 'integer', 'min:1', 'max:60'],
            'bunga' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['belum_lunas', 'lunas'])],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $pinjaman->update($data);

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();
        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil dihapus.');
    }
}