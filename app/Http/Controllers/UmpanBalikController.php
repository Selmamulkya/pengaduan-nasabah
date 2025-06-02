<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmpanBalik;

class UmpanBalikController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id'    => 'required|exists:complaints,id',
            'tanggung_jawab'  => 'required|integer|min:1|max:5',
            'keandalan'       => 'required|integer|min:1|max:5',
            'jaminan'         => 'required|integer|min:1|max:5',
            'empati'          => 'required|integer|min:1|max:5',
            'daya_tanggap'    => 'required|integer|min:1|max:5',
        ]);

        UmpanBalik::create($request->all());

        return redirect()->back()->with('success', 'Umpan balik berhasil dikirim.');
    }

    public function rekap()
    {
        $data = UmpanBalik::selectRaw('
            AVG(tanggung_jawab) as avg_tanggung_jawab,
            AVG(keandalan) as avg_keandalan,
            AVG(jaminan) as avg_jaminan,
            AVG(empati) as avg_empati,
            AVG(daya_tanggap) as avg_daya_tanggap
        ')->first();

        return view('rekap', compact('data'));
    }
    public function index()
{
    $complaints = Complaint::all();

    // Contoh penghitungan rata-rata feedback, sesuaikan dengan struktur tabel feedback kamu
    $rekapUmpanBalik = DB::table('feedbacks')->select(
        DB::raw('AVG(tanggung_jawab) as avg_tanggung_jawab'),
        DB::raw('AVG(keandalan) as avg_keandalan'),
        DB::raw('AVG(jaminan) as avg_jaminan'),
        DB::raw('AVG(empati) as avg_empati'),
        DB::raw('AVG(daya_tanggap) as avg_daya_tanggap')
    )->first();

    return view('complaints.index', compact('complaints', 'rekapUmpanBalik'));
}

}
