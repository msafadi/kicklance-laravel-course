<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Gate::before(function($user, $ability) {
            if ($user->type == 'super-admin') {
                return true;
            }
        });*/

        foreach(config('permissions') as $code => $lable) {
            Gate::define($code, function($user) use($code) {
                return $user->role->permissions()->where('permission', '=', $code)->exists();
            });
        }
    }
}
