<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Pilih Pinjaman (Anggota)</label>
        <select name="pinjaman_id" class="form-select @error('pinjaman_id') is-invalid @enderror" required>
            <option value="">-- Pilih Data Pinjaman --</option>
            @foreach($pinjaman as $p)
                <option value="{{ $p->id }}" @selected(old('pinjaman_id', $angsuran->pinjaman_id ?? '') == $p->id)>
                    {{ $p->anggota->no_anggota }} - {{ $p->anggota->nama }} (Total Pinjam: Rp {{ number_format($p->jumlah, 0, ',', '.') }})
                </option>
            @endforeach
        </select>
        @error('pinjaman_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Angsuran Ke-</label>
        <input type="number" name="angsuran_ke" class="form-control @error('angsuran_ke') is-invalid @enderror" value="{{ old('angsuran_ke', $angsuran->angsuran_ke ?? '') }}" min="1" required>
        @error('angsuran_ke')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Jatuh Tempo</label>
        <input type="date" name="jatuh_tempo" class="form-control @error('jatuh_tempo') is-invalid @enderror" value="{{ old('jatuh_tempo', $angsuran->jatuh_tempo ?? '') }}" required>
        @error('jatuh_tempo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Jumlah Tagihan (Rp)</label>
        <input type="number" name="jumlah_tagihan" class="form-control @error('jumlah_tagihan') is-invalid @enderror" value="{{ old('jumlah_tagihan', $angsuran->jumlah_tagihan ?? '') }}" min="0" required>
        @error('jumlah_tagihan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Jumlah Bayar (Rp)</label>
        <input type="number" name="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar', $angsuran->jumlah_bayar ?? '') }}" min="0">
        <small class="text-muted">Kosongkan jika belum dibayar</small>
        @error('jumlah_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" value="{{ old('tanggal_bayar', $angsuran->tanggal_bayar ?? '') }}">
        @error('tanggal_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="belum lunas" @selected(old('status', $angsuran->status ?? 'belum lunas') == 'belum lunas')>Belum Lunas</option>
            <option value="lunas" @selected(old('status', $angsuran->status ?? '') == 'lunas')>Lunas</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">Simpan Angsuran</button>
    <a href="{{ route('angsuran.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>