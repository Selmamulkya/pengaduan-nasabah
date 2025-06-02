@extends('adminlte::page')

@section('title', 'Daftar Pengaduan')

@section('content_header')
    <h1>Daftar Pengaduan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
              @can('isAdmin')
                <a href="{{ route('rekap.feedback') }}" class="btn btn-info">Lihat Rekap Feedback</a>
            @endcan
            <a href="{{ route('complaints.create') }}" class="btn btn-primary">Buat Pengaduan Baru</a>
        </div>
       
        <div class="card-body table-responsive p-0">
            @if($complaints->isEmpty())
                <p class="text-center">Belum ada pengaduan.</p>
            @else
            <table class="table table-bordered table-hover text-nowrap">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $complaint->name }}</td>
                        <td>{{ $complaint->address }}</td>
                        <td>{{ $complaint->phone }}</td>
                        <td>{{ $complaint->title }}</td>
                        <td>
                            <span class="badge 
                                {{ 
                                    $complaint->status == 'pending' ? 'bg-warning' : 
                                    ($complaint->status == 'in_progress' ? 'bg-info' : 'bg-success') 
                                }}">
                                {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                            </span>
                        </td>
                        <td>{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                           @can('view', $complaint)
                                <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-sm btn-info">Detail</a>
                            @endcan

                            @can('update', $complaint)
                            <a href="{{ route('complaints.edit', $complaint) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('delete', $complaint)
                            <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
{{-- @can('isAdmin') --}}
    {{-- <!-- Tambahkan card baru untuk rekap umpan balik -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Rekap Umpan Balik Pelayanan</h3>
        </div>
        <div class="card-body table-responsive p-0 w-50">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Rata-rata Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tanggung Jawab</td>
                        <td>{{ number_format($rekapUmpanBalik->avg_tanggung_jawab ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Keandalan</td>
                        <td>{{ number_format($rekapUmpanBalik->avg_keandalan ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Jaminan</td>
                        <td>{{ number_format($rekapUmpanBalik->avg_jaminan ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Empati</td>
                        <td>{{ number_format($rekapUmpanBalik->avg_empati ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Daya Tanggap</td>
                        <td>{{ number_format($rekapUmpanBalik->avg_daya_tanggap ?? 0, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

     <!-- Card Chart di bawah card tabel rekap -->
    <div class="card mt-4 w-50">
        <div class="card-header">
            <h3 class="card-title">Grafik Rekap Umpan Balik Pelayanan</h3>
        </div>
        <div class="card-body">
            <canvas id="feedbackChart"></canvas>
        </div>
    </div>

    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('feedbackChart').getContext('2d');

            const data = {
                labels: ['Tanggung Jawab', 'Keandalan', 'Jaminan', 'Empati', 'Daya Tanggap'],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: [
                        {{ $rekapUmpanBalik->avg_tanggung_jawab ?? 0 }},
                        {{ $rekapUmpanBalik->avg_keandalan ?? 0 }},
                        {{ $rekapUmpanBalik->avg_jaminan ?? 0 }},
                        {{ $rekapUmpanBalik->avg_empati ?? 0 }},
                        {{ $rekapUmpanBalik->avg_daya_tanggap ?? 0 }},
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const options = {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Nilai Rata-rata (1 - 5)'
                        }
                    }
                }
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        });
    </script>
    @endcan --}}
@stop
