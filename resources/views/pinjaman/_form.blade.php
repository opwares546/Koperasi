<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Anggota</label>
        <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach($anggota as $a)
                <option value="{{ $a->id }}" @selected(old('anggota_id', $pinjaman->anggota_id ?? '') == $a->id)>
                    {{ $a->no_anggota }} - {{ $a->nama }}
                </option>
            @endforeach
        </select>
        @error('anggota_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam', $pinjaman->tanggal_pinjam ?? date('Y-m-d')) }}" required>
        @error('tanggal_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Jumlah Pinjaman (Rp)</label>
        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $pinjaman->jumlah ?? '') }}" min="50000" required>
        @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Lama Angsuran (Bulan)</label>
        <input type="number" name="lama_angsuran" class="form-control @error('lama_angsuran') is-invalid @enderror" value="{{ old('lama_angsuran', $pinjaman->lama_angsuran ?? '') }}" min="1" max="60" required>
        @error('lama_angsuran')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Bunga (%)</label>
        <input type="number" step="0.1" name="bunga" class="form-control @error('bunga') is-invalid @enderror" value="{{ old('bunga', $pinjaman->bunga ?? '') }}" min="0" required>
        @error('bunga')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    @if(isset($pinjaman))
    <div class="col-md-6">
        <label class="form-label">Status Pinjaman</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="belum_lunas" @selected(old('status', $pinjaman->status) == 'belum_lunas')>Belum Lunas</option>
            <option value="lunas" @selected(old('status', $pinjaman->status) == 'lunas')>Lunas</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    @endif

    <div class="col-12">
        <label class="form-label">Keterangan (Opsional)</label>
        <textarea name="keterangan" rows="2" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $pinjaman->keterangan ?? '') }}</textarea>
        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">Simpan Pinjaman</button>
    <a href="{{ route('pinjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>