<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\UserBookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
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

//landing
/*
Route::get('/', function () {
    return Inertia::render('Landing', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('landing');
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');
//muestra un perfil de entidad
Route::get('/entity/{entity:username}', [EntityController::class, 'show'])->name('entityProfile');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categoryShow');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    //muestra los user entities
    Route::get('user/entities', [EntityController::class, 'index'])->name('entities');
    //muestra el form para crear/editar
    Route::get('user/entities/create', [EntityController::class, 'create'])->name('createEntity');
    Route::get('user/bookmarks', [UserBookmarkController::class, 'index'])->name('userBookmarks');
    Route::post('entities/bookmark/{entity}', [UserBookmarkController::class, 'toggle'])->name('bookmarkEntity');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('adminDashboard');
});
