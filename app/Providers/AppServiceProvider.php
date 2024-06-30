<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Schema;
use Str;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Schema::defaultStringLength(191);
        $users = User::all();
        foreach ($users as $user) {
            if ($user->uuid == null) {
                $user->update([
                                  'uuid' => Str::uuid(),
                              ]);
            }
        }
        RateLimiter::for('user-requests', function (Request $request) {
            return Limit::perMinute(200000)->by($request->user()?->id ?: $request->ip())->response(function () {
                return response('You have reached the request limit.', Response::HTTP_TOO_MANY_REQUESTS);
            });
        });
    }
}
