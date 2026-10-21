@extends('layouts.app')
@section('title', 'Edit Angsuran')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Edit Data Angsuran</h3>
    <p class="text-muted">Perbarui tagihan atau catat pelunasan angsuran.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('angsuran.update', $angsuran->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('angsuran._form')
            </form>
        </div>
    </div>
</div>
@endsection