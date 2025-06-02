@extends('adminlte::page')

@section('title', 'Detail Pengaduan')

@section('content_header')
    <h1>Detail Pengaduan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Judul</h5>
                    <p>{{ $complaint->title }}</p>
                    
                    <h5>Deskripsi</h5>
                    <p>{{ $complaint->description }}</p>

                    @isset($complaint->name)
                        <h5>Nama</h5>
                        <p>{{ $complaint->name }}</p>
                    @endisset

                    @isset($complaint->address)
                        <h5>Alamat</h5>
                        <p>{{ $complaint->address }}</p>
                    @endisset

                    @isset($complaint->phone)
                        <h5>No. HP</h5>
                        <p>{{ $complaint->phone }}</p>
                    @endisset
                </div>

                {{-- <div class="col-md-6">
                    <h5>Status</h5>
                    <span class="badge 
                        {{ 
                            $complaint->status == 'pending' ? 'bg-warning' : 
                            ($complaint->status == 'in_progress' ? 'bg-info' : 'bg-success') 
                        }}">
                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                    </span> --}}
                    
                    <h5 class="mt-4">Tanggal Dibuat</h5>
                    <p>{{ $complaint->created_at->format('d/m/Y H:i') }}</p>
                    
                    @if($complaint->response)
                        <h5>Respon Admin</h5>
                        <p>{{ $complaint->response }}</p>
                    @endif
                </div>
            </div>

          <h5>Status</h5>
<span class="badge 
    {{ 
        $complaint->status == 'pending' ? 'bg-warning' : 
        ($complaint->status == 'processing' ? 'bg-info' : 
        ($complaint->status == 'resolved' ? 'bg-success' : 'bg-danger'))
    }}">
    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
</span>

@can('isAdmin')
<form action="{{ route('complaints.updateStatus', $complaint->id) }}" method="POST" class="mt-3">
    @csrf
    @method('PATCH')
    <label for="status">Ubah Status Laporan</label>
    <select name="status" id="status" class="form-control" required>
        <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $complaint->status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
        <option value="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
    <button type="submit" class="btn btn-primary mt-2">Update Status</button>
</form>
@endcan



       <div class="card-footer">
    @if ($complaint->status == 'resolved' 
        && !$complaint->umpanBalik 
        && auth()->id() == $complaint->user_id 
        && auth()->user()->role != 'admin')
        
        <button class="btn btn-secondary" disabled>
            Isi feedback dulu sebelum bisa kembali
        </button>
    @else
        <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Kembali</a>
    @endif
</div>

@if ($complaint->status == 'resolved' 
    && !$complaint->umpanBalik 
    && auth()->id() == $complaint->user_id
    && auth()->user()->role != 'admin'  {{-- pastikan ini atribut role di user --}}
)
    @include('feedback', ['pengaduan' => $complaint])
@endif
    </div>
@stop
