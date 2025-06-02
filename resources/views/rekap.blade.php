@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rekapitulasi Umpan Balik SERVQUAL</h2>
    <canvas id="chartFeedback" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartFeedback').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tanggung Jawab', 'Keandalan', 'Jaminan', 'Empati', 'Daya Tanggap'],
            datasets: [{
                label: 'Nilai Rata-Rata',
                data: [
                    {{ $data->avg_tanggung_jawab }},
                    {{ $data->avg_keandalan }},
                    {{ $data->avg_jaminan }},
                    {{ $data->avg_empati }},
                    {{ $data->avg_daya_tanggap }}
                ],
                backgroundColor: [
                    '#36a2eb',
                    '#4bc0c0',
                    '#ffcd56',
                    '#ff6384',
                    '#9966ff'
                ],
                borderRadius: 10,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });
</script>
@endsection
