<?php

namespace App\Providers;

use App\Models\CopyTradingRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\Deposit;
use App\Models\Withdrawal;

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
    if (app()->isLocal()) {
        Model::preventLazyLoading(!app()->isProduction());
    }

    view()->composer('*', function ($view) {

        $pendingDepositsCount = Deposit::where('status', 'pending')->count();
        $pendingWithdrawalsCount = Withdrawal::where('status', 'pending')->count();
        $pendingCopyCount = CopyTradingRequest::where('status', 'pending')->count(); // ✅ ADD THIS

        $view->with('pendingDepositsCount', $pendingDepositsCount)
             ->with('pendingWithdrawalsCount', $pendingWithdrawalsCount)
             ->with('pendingCopyCount', $pendingCopyCount); // ✅ ADD THIS
    });
}
}
