<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AngsuranController extends Controller
{
    public function index(Request $request)
    {
        $angsuran = Angsuran::with(['pinjaman.anggota'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('pinjaman.anggota', function ($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('no_anggota', 'like', "%{$request->search}%");
                });
            })
            ->latest('jatuh_tempo')
            ->paginate(10)
            ->withQueryString();

        return view('angsuran.index', compact('angsuran'));
    }

    public function create()
    {
        // Hanya tampilkan pinjaman yang belum lunas
        $pinjaman = Pinjaman::with('anggota')->where('status', 'belum_lunas')->get();
        return view('angsuran.create', compact('pinjaman'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pinjaman_id' => ['required', 'exists:pinjaman,id'],
            'angsuran_ke' => ['required', 'integer', 'min:1'],
            'jatuh_tempo' => ['required', 'date'],
            'jumlah_tagihan' => ['required', 'numeric', 'min:0'],
            'jumlah_bayar' => ['nullable', 'numeric', 'min:0'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', 'string', Rule::in(['belum lunas', 'lunas'])],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        Angsuran::create($data);

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil dicatat.');
    }

    public function show(Angsuran $angsuran)
    {
        return view('angsuran.show', compact('angsuran'));
    }

    public function edit(Angsuran $angsuran)
    {
        $pinjaman = Pinjaman::with('anggota')
            ->where('status', 'belum_lunas')
            ->orWhere('id', $angsuran->pinjaman_id)
            ->get();
            
        return view('angsuran.edit', compact('angsuran', 'pinjaman'));
    }

    public function update(Request $request, Angsuran $angsuran)
    {
        $data = $request->validate([
            'pinjaman_id' => ['required', 'exists:pinjaman,id'],
            'angsuran_ke' => ['required', 'integer', 'min:1'],
            'jatuh_tempo' => ['required', 'date'],
            'jumlah_tagihan' => ['required', 'numeric', 'min:0'],
            'jumlah_bayar' => ['nullable', 'numeric', 'min:0'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', 'string', Rule::in(['belum lunas', 'lunas'])],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $angsuran->update($data);

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil diperbarui.');
    }

    public function destroy(Angsuran $angsuran)
    {
        $angsuran->delete();
        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil dihapus.');
    }
}