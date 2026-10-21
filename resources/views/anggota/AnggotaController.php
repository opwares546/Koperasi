<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggota = Anggota::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $keyword = $request->search;
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('no_anggota', 'like', "%{$keyword}%")
                      ->orWhere('nik', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        // Fitur sederhana untuk membuat nomor anggota otomatis (KOP-0001, dst)
        $lastAnggota = Anggota::orderBy('id', 'desc')->first();
        $nextNo = $lastAnggota ? 'KOP-' . str_pad($lastAnggota->id + 1, 4, '0', STR_PAD_LEFT) : 'KOP-0001';

        return view('anggota.create', compact('nextNo'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_anggota' => ['required', 'string', 'max:30', 'unique:anggota,no_anggota'],
            'nik' => ['required', 'string', 'max:16', 'unique:anggota,nik'],
            'nama' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'unique:anggota,email'],
            'tanggal_bergabung' => ['required', 'date'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        Anggota::create($data);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $data = $request->validate([
            'no_anggota' => ['required', 'string', 'max:30', Rule::unique('anggota')->ignore($anggota->id)],
            'nik' => ['required', 'string', 'max:16', Rule::unique('anggota')->ignore($anggota->id)],
            'nama' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', Rule::unique('anggota')->ignore($anggota->id)],
            'tanggal_bergabung' => ['required', 'date'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $anggota->update($data);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        
        try {
            $anggota->delete();
            return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Cegah hapus data jika anggota ini sudah punya transaksi simpanan/pinjaman
            return back()->with('error', 'Anggota tidak bisa dihapus karena sudah memiliki riwayat transaksi.');
        }
    }
}