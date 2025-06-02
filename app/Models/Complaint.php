<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Complaint extends Model
{
    // jika kamu ingin mass assignment untuk kolom tertentu
    protected $fillable = [
        'title', 
        'description',
        'user_id',
        'name',
    'address',
    'phone', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function umpanBalik()
{
    return $this->hasOne(UmpanBalik::class, 'pengaduan_id');
}


}
