<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UmpanBalik extends Model
{
    use HasFactory;

    protected $table = 'umpan_balik';

    protected $fillable = [
        'pengaduan_id',
        'tanggung_jawab',
        'keandalan',
        'jaminan',
        'empati',
        'daya_tanggap',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Complaint::class, 'pengaduan_id');
    }
    public function complaint()
{
    return $this->belongsTo(Complaint::class, 'pengaduan_id');
}
}
