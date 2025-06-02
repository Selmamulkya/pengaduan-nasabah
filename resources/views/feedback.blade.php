<form action="{{ route('umpan-balik.store') }}" method="POST" class="mt-3">
    @csrf
    <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">

    @php
    $criteria = [
        'tanggung_jawab' => 'Tanggung Jawab',
        'keandalan' => 'Keandalan',
        'jaminan' => 'Jaminan',
        'empati' => 'Empati',
        'daya_tanggap' => 'Daya Tanggap',
    ];
    @endphp

    @foreach($criteria as $key => $label)
        <div class="mb-3">
            <label class="form-label">{{ $label }}:</label>
            <div>
                @for ($i = 1; $i <= 5; $i++)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="{{ $key }}" id="{{ $key }}{{ $i }}" value="{{ $i }}" required>
                        <label class="form-check-label" for="{{ $key }}{{ $i }}">{{ $i }}</label>
                    </div>
                @endfor
            </div>
        </div>
    @endforeach

    <button type="submit" class="btn btn-success">Kirim Umpan Balik</button>
</form>
