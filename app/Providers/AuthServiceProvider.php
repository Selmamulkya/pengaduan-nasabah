<?php

namespace App\Providers;

use App\Models\Complaint;
use App\Policies\ComplaintPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; 
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Complaint::class => ComplaintPolicy::class,
        // Tambahkan model dan policy lainnya di sini
    ];

    /**
     * Register any authentication / authorization services.
     */
   public function boot()
{
    $this->registerPolicies();

    Gate::define('isAdmin', function ($user) {
        return $user->is_admin == true;
    });
}
}