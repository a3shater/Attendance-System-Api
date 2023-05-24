<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Area;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Shift;
use App\Models\User;
use App\Policies\AreaPolicy;
use App\Policies\AttendancePolicy;
use App\Policies\CompanyPolicy;
use App\Policies\HolidayPolicy;
use App\Policies\ShiftPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        User::class => UserPolicy::class,
        Shift::class => ShiftPolicy::class,
        Holiday::class => HolidayPolicy::class,
        Company::class => CompanyPolicy::class,
        Attendance::class => AttendancePolicy::class,
        Area::class => AreaPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
