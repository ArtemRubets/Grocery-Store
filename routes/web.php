<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategory;
use App\Http\Controllers\Dashboard\CurrencyController as DashboardCurrencyController;
use App\Http\Controllers\Dashboard\GeneralController;
use App\Http\Controllers\Dashboard\IndexController as DashboardIndex;
use App\Http\Controllers\Dashboard\PaymentsController;
use App\Http\Controllers\Dashboard\ProductController as DashboardProduct;
use App\Http\Controllers\Dashboard\TrashController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminRole;
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

/*
 * Dashboard
 * */
Route::middleware('auth')->prefix('/dashboard')->name('dashboard.')->group(function () {
    /*
     * Dashboard Home
     * */
    Route::get('/', [DashboardIndex::class, 'index'])->name('home');

    Route::middleware('management')->group(function () {
        //TODO unique slug column for categories and products
        /*
         * Products
         * */
        Route::get('product-categories', [DashboardCategory::class, 'productCategories'])
            ->name('product-categories');
        Route::resource('categories', DashboardCategory::class)
            ->except('show');
        Route::resource('products', DashboardProduct::class)
            ->except('show');

        /*
         * Products Trash
         * */
        Route::prefix('/trash')->name('trash.')->group(function () {

            Route::prefix('/products')->name('products.')->group(function () {
                Route::get('/', [TrashController::class, 'productsTrashIndex'])->name('index');
                Route::post('/restore/{id}', [TrashController::class, 'restore'])->name('restore');
                Route::delete('/force-delete/{id}', [TrashController::class, 'forceDelete'])->name('forceDelete');
            });
        });

        /*
         * Admin
         * */
        Route::middleware(AdminRole::class)->group(function () {
            /*
            * Payments
            * */
            Route::prefix('/payments')->name('payments.')->group(function () {

                Route::get('/', [PaymentsController::class, 'index'])->name('settings');
                Route::post('/setPaymentsSettings', [PaymentsController::class, 'setPaymentsSettings'])->name('setPaymentsSettings');
                Route::resource('/currency', DashboardCurrencyController::class)
                    ->only(['store'])->names('currency');
                Route::delete('/currency/destroyMany', [DashboardCurrencyController::class, 'destroyMany'])->name('currency.destroyMany');
                Route::get('/currency/update-rates', [DashboardCurrencyController::class, 'updateCurrenciesRates'])->name('currency.updateRates');
            });

            /*
             * General Settings
             * */
            Route::prefix('/general')->name('general.')->group(function () {
                Route::get('/index', [GeneralController::class, 'index'])->name('index');
            });
        });

    });
});
/*
 * Home Page
 * */
Route::get('/', [IndexController::class, 'index'])->name('home');
/*
 * Cart
 * */
Route::get('/cart', [CartController::class, 'index'])->name('checkout');
Route::post('/cart/add/{product_slug}', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cart/remove/{product_slug}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/cart/removeOne/{product_slug}', [CartController::class, 'removeOneProduct'])->name('removeOne');
/*
 * Newsletter TODO needed queue
 * */
Route::post('/send-newsletter', [IndexController::class, 'sendNewsletter'])->name('newsletter');
/*
 * Auth
 * */
Route::prefix('/auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::match(['POST', 'GET'], '/login/{company?}/{redirect?}', [AuthController::class, 'login'])->name('login');

//    Route::get('/login/with/{company}', [AuthController::class, 'loginWith'])->name('login-with');
//    Route::get('/login/with/redirect/{company}', [AuthController::class, 'loginWithRedirect'])->name('login-with-redirect');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
/*
 * Clients Routes
 * */
Route::get('/product-search', [ProductController::class, 'productsSearch'])->name('products-search');
Route::get('/{product}', [ProductController::class, 'index'])->name('good');

Route::get('/category/{category_name}', [CategoryController::class, 'index'])->name('category');
Route::post('/subscription/{product}', [ProductController::class, 'subscription'])->name('subscription');
Route::get('/change-currency/{code}', [CurrencyController::class, 'changeCurrency'])->name('changeCurrency');





