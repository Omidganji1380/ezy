<?php

use App\Livewire\Admin\AboutUs;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\ContactUs;
use App\Livewire\Admin\Customers\Forms;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Options;
use App\Livewire\Admin\Portfolios;
use App\Livewire\Admin\Sliders;
use App\Livewire\Admin\UrlRedirector\UrlRedirector;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Weblog;
use App\Livewire\Admin\WeblogEdit;
use App\Livewire\Front\Index;
use App\Livewire\Front\InfoForm\InfoForm;
use App\Livewire\Front\Pagebuilder\Pagebuilder;
use App\Livewire\Front\Pagebuilder\Show;
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

Route::get('/', Index::class)->name('index');
Route::get('/f/{phone}', InfoForm::class)->name('infoForm');
Route::get('/r/{link}', function ($link) {
    $url = \App\Models\UrlRedirector::query()->where('url', $link)->first();
    if (!$url) {
        abort(404);
    }
    else {
        echo "<script>";
        echo "window.location.replace('" . $url->redirectTo . "');";
        echo "</script>";
    }
})->name('redirectTo');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', \App\Livewire\Front\Dashboard\Dashboard::class)->name('front.dashboard');
    Route::get('/logout', [\App\Livewire\Front\Auth::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'pb'], function () {
        Route::get('/', \App\Livewire\Front\Pagebuilder\Index::class)->name('pagebuilder.index');
        Route::get('/{link}', Pagebuilder::class)->name('pagebuilder.pagebuilder');
    });
});


Route::group(['prefix' => 'manager', 'middleware' => 'auth'], function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::get('/options', Options::class)->name('admin.options');
    Route::get('/users', Users::class)->name('admin.users');
    Route::get('/pbOptions', \App\Livewire\Admin\Pb\Options::class)->name('admin.pbOptions');
    Route::get('/redirector', UrlRedirector::class)->name('admin.redirector');

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/forms', Forms::class)->name('admin.customers.forms');
    });
    Route::group(['prefix' => 'index'], function () {
        Route::get('/sliders', Sliders::class)->name('admin.sliders');
        Route::get('/categories', Categories::class)->name('admin.categories');
        Route::get('/portfolios', Portfolios::class)->name('admin.portfolios');
        Route::get('/about', AboutUs::class)->name('admin.about');
        Route::get('/contact', ContactUs::class)->name('admin.contact');
    });
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', Weblog::class)->name('admin.blogs');
        Route::get('/edit/{id}', WeblogEdit::class)->name('admin.blog.edit');
        Route::post('/uploadImage/{id}', [WeblogEdit::class, 'uploadImage'])->name('uploadImage');
    });
});
Route::get('/{link}', show::class)->name('pb.show');

