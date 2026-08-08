<?php

namespace App\Providers;

use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        Auth::viaRequest('device-key', function (Request $request) {
            $key = $request->header('X-Device-Key');

            if ($key === null || ! in_array($key, config('services.device_keys'), true)) {
                return null;
            }

            return new GenericUser(['id' => null, 'origen' => $key]);
        });
    }
}
