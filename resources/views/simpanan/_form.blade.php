<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Anggota</label>
        <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach($anggota as $a)
                <option value="{{ $a->id }}" @selected(old('anggota_id', $simpanan->anggota_id ?? '') == $a->id)>
                    {{ $a->no_anggota }} - {{ $a->nama }}
                </option>
            @endforeach
        </select>
        @error('anggota_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Transaksi</label>
        <input type="date" name="tanggal_transaksi" class="form-control @error('tanggal_transaksi') is-invalid @enderror" value="{{ old('tanggal_transaksi', $simpanan->tanggal_transaksi ?? date('Y-m-d')) }}" required>
        @error('tanggal_transaksi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Jenis Simpanan</label>
        <select name="jenis_simpanan" class="form-select @error('jenis_simpanan') is-invalid @enderror" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="pokok" @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '') === 'pokok')>Simpanan Pokok</option>
            <option value="wajib" @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '') === 'wajib')>Simpanan Wajib</option>
            <option value="sukarela" @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '') === 'sukarela')>Simpanan Sukarela</option>
        </select>
        @error('jenis_simpanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Jumlah (Rp)</label>
        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $simpanan->jumlah ?? '') }}" min="1000" required>
        @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Keterangan (Opsional)</label>
        <textarea name="keterangan" rows="2" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $simpanan->keterangan ?? '') }}</textarea>
        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    <a href="{{ route('simpanan.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>