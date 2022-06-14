<?php

//use Illuminate\Foundation\Application;
//use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\UserBookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminEntityController;
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
Route::get('/categories/{category?}', [CategoryController::class, 'show'])->name('category.show');

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
    Route::post('/entity/profilepic', [EntityController::class, 'storeProfilePic'])->name('entity.profilepic.store');

    Route::get('user/bookmarks', [UserBookmarkController::class, 'index'])->name('user.bookmarks');
    Route::post('user/bookmarks/{entity}', [UserBookmarkController::class, 'toggle'])->name('entities.bookmark');
    //posts
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});


//admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role:super-admin'
])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    //locations
    Route::get('/locations/{location?}', [AdminLocationController::class, 'index'])->name('admin.locations');
    //categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.delete');
    //users
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    //entities
    Route::get('/entities', [AdminEntityController::class, 'index'])->name('admin.entities');
    Route::get('/entities/{entity}', [AdminEntityController::class, 'show'])->name('admin.entities.show');
    // show form, store form, update form, delete form
    Route::get('/entity', [AdminEntityController::class, 'create'])->name('admin.entities.create');
    Route::post('/entity', [AdminEntityController::class, 'store'])->name('admin.entities.store');
    Route::put('/entity/{entity}', [AdminEntityController::class, 'update'])->name('admin.entities.update');
});
