<?php

namespace App\Providers;

use App\Models\StoreInfo;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $appUrl = env('APP_URL');
        if (
            (env('APP_SCHEME') === 'https') ||
            (env('FORCE_HTTPS', false)) ||
            (is_string($appUrl) && stripos($appUrl, 'https://') === 0)
        ) {
            \URL::forceScheme('https');
        }


        view()->composer('*', function ($view) {
            $storeInfo = StoreInfo::first();
            $view->with('storeInfo', $storeInfo);
        });

        Blade::directive('toIDR', function ($amount) {
            return "<?php echo 'Rp. '.number_format($amount,0,',','.').',00'; ?>";
        });
    }
}
