<?php

namespace App\Providers;

use App\Models\Item;
use App\Policies\ItemPolicy;
use App\Models\BuyingTransaction;
use App\Policies\BuyingTransactionPolicy;
use App\Models\SellingTransaction;
use App\Policies\SellingTransactionPolicy;
use App\Models\Report;
use App\Policies\ReportPolicy;
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
        Item::class => ItemPolicy::class,
        BuyingTransaction::class => BuyingTransactionPolicy::class,
        SellingTransaction::class => SellingTransactionPolicy::class,
        Report::class => ReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user-management-access','App\Policies\UserPolicy@userManagementAccess');
    }
}
