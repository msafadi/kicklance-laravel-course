<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\UserType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('{lang}')->group(function() {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::delete('/cart', 'CartController@destroy')->name('cart.destroy');
    Route::patch('/cart', 'CartController@update')->name('cart.update');

    Route::post('/checkout', 'CheckoutController@store')->name('checkout');
    Route::get('/orders', 'OrdersController@index')->name('orders');
    Route::get('/orders/{order}', 'OrdersController@show')->name('orders.show');

    Route::get('/orders/{order}/payment/callback', 'PaymentsController@callback')->name('payment.callback');
});

Route::get('notifications/{id}', 'NotificationsController@read')->name('notifications.read');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'user.type:admin,super-admin'],
], function() {

    Route::prefix('categories')->as('categories.')->middleware('auth')->group(function() {
        Route::get('xml', 'CategoriesController@xml');
        Route::get('json', 'CategoriesController@json');
        
        Route::get('/', 'CategoriesController@index')->name('index');
        Route::get('/create', 'CategoriesController@create')->name('create');
        Route::post('/', 'CategoriesController@store')->name('store');
        Route::get('/{id}', 'CategoriesController@show')->name('show');
        Route::get('/{id}/edit', 'CategoriesController@edit')->name('edit');
        Route::put('/{id}', 'CategoriesController@update')->name('update');
        Route::delete('/{id}', 'CategoriesController@destroy')->name('destroy');

       
    });

    Route::get('/products/trash', 'ProductsController@trash')->name('products.trash');
    Route::put('/products/{id}/restore', 'ProductsController@restore')->name('products.restore');
    Route::delete('/products/{id}/force', 'ProductsController@forceDelete')->name('products.forceDelete');
    Route::resource('/products', 'ProductsController')->names([
        'index' => 'products.index',
        'create' => 'products.create',
    ]);

    Route::resource('roles', 'RolesController');
});

Route::middleware('auth')->group(function() {
    Route::post('favourites', 'FavouritesController@store')->name('favourites.store');
    Route::delete('favourites/{id}', 'FavouritesController@destroy')->name('favourites.destroy');
    
    Route::post('ratings/product', 'RatingsController@storeProductRating');
    Route::post('ratings/user', 'RatingsController@storeUserRating');
});

Route::get('currency/convert/{from}/{to}', 'CurrencyController@convert');


Route::view('/home', 'welcome');

Route::redirect('/welcome', '/home');

Route::get('/env', function() {
    dd( config('app.developer') );
});

//Route::get('/index', 'IndexController@index');
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/read/{id}/{print?}', [NewsController::class, 'read']);

// Route::match()
// Route::any()

// Request Methods in HTTP
/*
GET
POST
PUT
PATCH
DELETE
HEAD
OPTIONS
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/{lang?}', 'IndexController@index');

if (App::environment('production')) {
    Route::get('storage/{file}', function($file) {
        $path = storage_path('app/public/' . $file);
        if (!is_file($path)) {
            abort(404);
        }
        return response()->file($path);

    })->where('file', '.+');
}