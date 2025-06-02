<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplaintPolicy
{
    use HandlesAuthorization;

    // Admin bisa akses semua
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true; // Admin bisa semua aksi
        }
    }

    // User biasa hanya bisa lihat pengaduan miliknya (detail)
    public function view(User $user, Complaint $complaint)
    {
        return $user->id === $complaint->user_id;
    }

    // User biasa bisa buat pengaduan
    public function create(User $user)
    {
        return true;
    }

    // User biasa bisa update pengaduan miliknya
    public function update(User $user, Complaint $complaint)
    {
        return $user->id === $complaint->user_id;
    }

    // Hanya admin yang bisa hapus (karena sudah di before())
    public function delete(User $user, Complaint $complaint)
    {
        return false; // user biasa tidak bisa hapus
    }
}
