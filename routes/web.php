<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Guest routes
Route::middleware('guest:web')->group(function () {
    // User Auth
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('user.login');
        Route::post('/login-post', 'login')->name('user.login.submit');
        Route::get('/register', 'register')->name('user.register');
    });
});

Route::middleware('guest:admin')->prefix('admin')->group(function () {
    // Admin Auth
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/login', 'index')->name('admin.login');
        Route::post('/login', 'login')->name('admin.login.submit');
    });
});

// Authenticated user routes
Route::middleware('auth:web')->group(function () {
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('/home', 'index')->name('user.home');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('user.logout');
    });
});

// Authenticated admin routes
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/profile', 'profile')->name('admin.profile');
        Route::post('/update-profile', 'updateProfile')->name('admin.profile.update');
        Route::get('/logout', 'logout')->name('admin.logout');
    });
    // Admin Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
        // Manage Home Banners, Sliders, Desc section
        Route::get('/home', 'viewHome')->name('admin.manage.home');
        Route::get('/add/home', 'create')->name('admin.add.home');
        Route::post('/store/home', 'store')->name('admin.store.home');
        Route::get('/edit/home/{id}', 'edit')->name('admin.edit.home');
        Route::post('/update/home/{id}', 'update')->name('admin.update.home');
        Route::get('/delete/home/{id}', 'delete')->name('admin.delete.home');
    });

    //Site Content Routes
    Route::controller(SiteContentController::class)->group(function () {
        Route::get('/site-content', 'index')->name('admin.site-content');
        Route::post('/update/site-content', 'updateContent')->name('admin.site-content.update');

        Route::get('/social-links', 'socialLinks')->name('admin.social-links');
        Route::post('/update/social-links', 'updateSocialLinks')->name('admin.social-links.update');
    });

    // Featured Routes
    Route::controller(FeaturedController::class)->group(function () {
        Route::get('/featured', 'index')->name('admin.manage.featured');
        Route::get('/add/featured', 'create')->name('admin.add.featured');
        Route::post('/store/featured', 'store')->name('admin.store.featured');
        Route::get('/edit/featured/{id}', 'edit')->name('admin.edit.featured');
        Route::post('/update/featured/{id}', 'update')->name('admin.update.featured');
        Route::get('/delete/featured/{id}', 'delete')->name('admin.delete.featured');
    });

    // About Us Routes
    Route::controller(AboutUsController::class)->group(function () {
        Route::get('/about-us', 'index')->name('admin.manage.about-us');
        Route::post('/about-us/update', 'updateAboutUs')->name('admin.update.about-us');
        // Stats
        Route::get('/about-us/stats/create', 'createStats')->name('admin.about-us.create.stats');
        Route::post('/about-us/stats/store', 'storeStats')->name('admin.about-us.store.stats');
        Route::get('/about-us/stats/edit/{id}', 'editStats')->name('admin.about-us.edit.stats');
        Route::post('/about-us/stats/update/{id}', 'updateStats')->name('admin.about-us.update.stats');
        Route::get('/about-us/stats/delete/{id}', 'deleteStats')->name('admin.about-us.delete.stats');
        // Company Logos and links 
        Route::get('/about-us/client/create', 'createClient')->name('admin.about-us.create.client');
        Route::post('/about-us/client/store', 'storeClient')->name('admin.about-us.store.client');
        Route::get('/about-us/client/edit/{id}', 'editClient')->name('admin.about-us.edit.client');
        Route::post('/about-us/client/update/{id}', 'updateClient')->name('admin.about-us.update.client');
        Route::get('/about-us/client/delete/{id}', 'deleteClient')->name('admin.about-us.delete.client');
    });

    // Services Routes
    Route::controller(ServicesController::class)->group(function () {
        Route::get('/services', 'index')->name('admin.manage.services');
        Route::get('/add/service', 'create')->name('admin.add.service');
        Route::post('/store/service', 'store')->name('admin.store.service');
        Route::get('/edit/service/{id}', 'edit')->name('admin.edit.service');
        Route::post('/update/service/{id}', 'update')->name('admin.update.service');
        Route::get('/delete/service/{id}', 'delete')->name('admin.delete.service');
    });
});

// Frontend Routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});
