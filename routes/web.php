<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RecetteCategorieController;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return redirect()->route('home', ['login' => 1]);
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/', [RecetteController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');

    // Group Routes
    Route::get('/groups', [\App\Http\Controllers\GroupeController::class, 'index'])->name('groups');
    Route::post('/groups', [\App\Http\Controllers\GroupeController::class, 'store'])->name('groups.store');
    Route::put('/groups/{id}', [\App\Http\Controllers\GroupeController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{id}', [\App\Http\Controllers\GroupeController::class, 'destroy'])->name('groups.destroy');
    Route::post('/groups/{id}/leave', [\App\Http\Controllers\GroupeController::class, 'leave'])->name('groups.leave');
    // Recipe Creation
    Route::get('/recipe/create', [\App\Http\Controllers\RecetteController::class, 'create'])->name('recipe.create');
    Route::post('/recipe/store', [\App\Http\Controllers\RecetteController::class, 'store'])->name('recipe.store');
    
});

Route::get('/recipe/random', [App\Http\Controllers\RecetteController::class, 'random'])->name('recipe.random');
Route::get('/recipe/{id}', [RecetteController::class, 'show'])->name('recipe');


Route::get('/categories', [RecetteCategorieController::class, 'index'])->name('categories.list');

Route::get('/categories/{id}', [RecetteCategorieController::class, 'show'])->name('category.show');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Categories
    Route::get('/categories', [\App\Http\Controllers\Admin\AdminCategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [\App\Http\Controllers\Admin\AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [\App\Http\Controllers\Admin\AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [\App\Http\Controllers\Admin\AdminCategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/categories/{id}/toggle-status', [\App\Http\Controllers\Admin\AdminCategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    // Recipe Types (Types de plats)
    Route::get('/recipe-types', [\App\Http\Controllers\Admin\AdminRecipeTypeController::class, 'index'])->name('recipe-types');
    Route::post('/recipe-types', [\App\Http\Controllers\Admin\AdminRecipeTypeController::class, 'store'])->name('recipe-types.store');
    Route::put('/recipe-types/{id}', [\App\Http\Controllers\Admin\AdminRecipeTypeController::class, 'update'])->name('recipe-types.update');
    Route::delete('/recipe-types/{id}', [\App\Http\Controllers\Admin\AdminRecipeTypeController::class, 'destroy'])->name('recipe-types.destroy');

    // Ingredients
    Route::get('/ingredients', [\App\Http\Controllers\Admin\AdminIngredientController::class, 'index'])->name('ingredients');
    Route::post('/ingredients', [\App\Http\Controllers\Admin\AdminIngredientController::class, 'store'])->name('ingredients.store');
    Route::put('/ingredients/{id}', [\App\Http\Controllers\Admin\AdminIngredientController::class, 'update'])->name('ingredients.update');
    Route::delete('/ingredients/{id}', [\App\Http\Controllers\Admin\AdminIngredientController::class, 'destroy'])->name('ingredients.destroy');
    Route::post('/ingredients/{id}/certify', [\App\Http\Controllers\Admin\AdminIngredientController::class, 'certify'])->name('ingredients.certify');

    // Ingredient Categories (Types)
    Route::get('/ingredient-categories', [\App\Http\Controllers\Admin\AdminIngredientCategoryController::class, 'index'])->name('ingredient-categories');
    Route::post('/ingredient-categories', [\App\Http\Controllers\Admin\AdminIngredientCategoryController::class, 'store'])->name('ingredient-categories.store');
    Route::put('/ingredient-categories/{id}', [\App\Http\Controllers\Admin\AdminIngredientCategoryController::class, 'update'])->name('ingredient-categories.update');
    Route::delete('/ingredient-categories/{id}', [\App\Http\Controllers\Admin\AdminIngredientCategoryController::class, 'destroy'])->name('ingredient-categories.destroy');
    Route::post('/ingredient-categories/{id}/toggle-status', [\App\Http\Controllers\Admin\AdminIngredientCategoryController::class, 'toggleStatus'])->name('ingredient-categories.toggle-status');

    // Measurements
    Route::get('/measurements', [\App\Http\Controllers\Admin\AdminMeasurementController::class, 'index'])->name('measurements');
    Route::post('/measurements', [\App\Http\Controllers\Admin\AdminMeasurementController::class, 'store'])->name('measurements.store');
    Route::put('/measurements/{id}', [\App\Http\Controllers\Admin\AdminMeasurementController::class, 'update'])->name('measurements.update');
    Route::delete('/measurements/{id}', [\App\Http\Controllers\Admin\AdminMeasurementController::class, 'destroy'])->name('measurements.destroy');

    // Cooking Types
    Route::get('/cooking-types', [\App\Http\Controllers\Admin\AdminTypeCuissonController::class, 'index'])->name('cooking-types');
    Route::post('/cooking-types', [\App\Http\Controllers\Admin\AdminTypeCuissonController::class, 'store'])->name('cooking-types.store');
    Route::put('/cooking-types/{id}', [\App\Http\Controllers\Admin\AdminTypeCuissonController::class, 'update'])->name('cooking-types.update');
    Route::delete('/cooking-types/{id}', [\App\Http\Controllers\Admin\AdminTypeCuissonController::class, 'destroy'])->name('cooking-types.destroy');

    // Users
    Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users');
    Route::post('/users/{id}/toggle-admin', [\App\Http\Controllers\Admin\AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\AdminSettingController::class, 'index'])->name('settings');
});