<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Complaint; // import Complaint

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [       // <-- ini properti, bukan fungsi
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
