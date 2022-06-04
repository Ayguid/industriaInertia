<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\UserBookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;
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

Route::get('/test', [TestController::class, 'index'])->name('tester');

Route::get('/', [LandingController::class, 'index'])->name('landing');
//muestra un perfil de entidad
Route::get('/entity/{entity:username}', [EntityController::class, 'show'])->name('entity.profile');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //muestra los user entities
    Route::get('user/entities', [EntityController::class, 'index'])->name('entities');
    //muestra el form para crear/editar
    Route::get('user/entities/create', [EntityController::class, 'create'])->name('entities.create');
    Route::get('user/bookmarks', [UserBookmarkController::class, 'index'])->name('user.bookmarks');
    Route::post('user/bookmarks/{entity}', [UserBookmarkController::class, 'toggle'])->name('entities.bookmark');
    //posts
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role:super-admin'
])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/categories', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/entities', [AdminController::class, 'entities'])->name('admin.entities');
    Route::get('/locations/{location?}', [AdminController::class, 'locations'])->name('admin.locations');
});
