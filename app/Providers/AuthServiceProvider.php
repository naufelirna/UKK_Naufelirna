<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
// tambah mmodel dan policy yg pengen dihubungin
use App\Models\Laporan;
use App\Policies\LaporanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * contoh: pas pake laporan::class, laravel ntar tau
     * harus pake laporanpolicy buat ngeek izin akses
     */
    protected $policies = [
        Laporan::class => LaporanPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); //daftarin semua policy yg ada di $policies
    }
}
