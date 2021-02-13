<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('parent', function($attribute, $value, $parameters, $validator) {
            $id = $parameters[0];

            $categories = Category::where('id', '<>', $id)
                ->where(function($query) use($id) {
                    $query->where('parent_id', '<>', $id)
                        ->orWhereNull('parent_id');
                })
                ->pluck('id')->toArray();
            if (!in_array($value, $categories)) {
                return false;
            }

            return true;
        }, 'Invalid parent to use!');


        if (App::environment('production')) {
            app()->singleton('path.public', function() {
                return base_path('public_html');
            });
        }
    }
}
