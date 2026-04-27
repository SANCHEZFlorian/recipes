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

// Password Reset
Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::get('/', [RecetteController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    // Group Routes
    Route::get('/groups', [\App\Http\Controllers\GroupeController::class, 'index'])->name('groups');
    Route::get('/groups/{id}', [\App\Http\Controllers\GroupeController::class, 'show'])->name('groups.show');
    Route::post('/groups', [\App\Http\Controllers\GroupeController::class, 'store'])->name('groups.store');
    Route::put('/groups/{id}', [\App\Http\Controllers\GroupeController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{id}', [\App\Http\Controllers\GroupeController::class, 'destroy'])->name('groups.destroy');
    Route::post('/groups/{id}/leave', [\App\Http\Controllers\GroupeController::class, 'leave'])->name('groups.leave');
    
    // Group Members and Invites
    Route::post('/groups/{id}/members', [\App\Http\Controllers\GroupeController::class, 'addMember'])->name('groups.members.add');
    Route::delete('/groups/{id}/members/{user_id}', [\App\Http\Controllers\GroupeController::class, 'removeMember'])->name('groups.members.remove');
    Route::delete('/groups/{id}/invitations/{invitation_id}', [\App\Http\Controllers\GroupeController::class, 'revokeInvitation'])->name('groups.invitations.revoke');
    // Recipe Creation
    Route::get('/recipe/create', [\App\Http\Controllers\RecetteController::class, 'create'])->name('recipe.create');
    Route::post('/recipe/store', [\App\Http\Controllers\RecetteController::class, 'store'])->name('recipe.store');
    Route::get('/recipe/{id}/edit', [\App\Http\Controllers\RecetteController::class, 'edit'])->name('recipe.edit');
    Route::put('/recipe/{id}/update', [\App\Http\Controllers\RecetteController::class, 'update'])->name('recipe.update');
    Route::delete('/recipe/{id}', [\App\Http\Controllers\RecetteController::class, 'destroy'])->name('recipe.destroy');
    
    // Interactions Sociales (Favoris & Avis)
    Route::post('/recipe/{id}/favorite', [\App\Http\Controllers\RecetteInteractionController::class, 'toggleFavorite'])->name('recipe.favorite');
    Route::post('/recipe/{id}/review', [\App\Http\Controllers\RecetteInteractionController::class, 'storeAvis'])->name('recipe.review');
    Route::delete('/recipe/review/{id}', [\App\Http\Controllers\RecetteInteractionController::class, 'destroyAvis'])->name('recipe.review.destroy');
    Route::get('/profile/favorites', [\App\Http\Controllers\RecetteInteractionController::class, 'userFavorites'])->name('profile.favorites');
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

// Mail Previews (Local Only)
if (app()->environment('local')) {
    Route::prefix('mail-previews')->name('mail-previews.')->group(function () {
        Route::get('/', [\App\Http\Controllers\MailPreviewController::class, 'index'])->name('index');
        Route::get('/welcome', [\App\Http\Controllers\MailPreviewController::class, 'welcome'])->name('welcome');
        Route::get('/invitation', [\App\Http\Controllers\MailPreviewController::class, 'invitation'])->name('invitation');
        Route::get('/reset-password', [\App\Http\Controllers\MailPreviewController::class, 'reset'])->name('reset');
    });
}