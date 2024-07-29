<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // this will replace the register form title when registering an employee
        View::share('reg_emp_title', 'Register an Employee');

        // this will replace the register form title when registering an admin
        View::share('reg_adm_title', 'Register an Admin'); 
        
    }
}
