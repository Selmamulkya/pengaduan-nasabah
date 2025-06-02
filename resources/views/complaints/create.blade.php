@extends('adminlte::page')

@section('title', 'Buat Pengaduan Baru')

@section('content_header')
    <h1>Buat Pengaduan Baru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('complaints.store') }}" method="POST">
                @csrf
                 <div class="form-group">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $complaint->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="address">Alamat</label>
    <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $complaint->address ?? '') }}</textarea>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="phone">No. HP</label>
    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
        value="{{ old('phone', $complaint->phone ?? '') }}">
    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                <div class="form-group">
                    <label for="title">Judul Pengaduan</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
               


                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop