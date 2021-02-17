<?php

use App\Http\Controllers\IRC\{CreateConfigController,
    CreateNickController,
    DeleteConfigController,
    DeleteNickController,
    IndexNickController,
    ListConfigController,
    ListNickController,
    UpdateConfigController,
    UpdateNickController};
use Illuminate\Support\Facades\Route;

/**
 * Public routes
 */
Route::get('/', fn () => view('welcome'));

/**
 * Restricted routes of panel
 */
Route::middleware('auth')
    ->prefix('panel')
    ->group(function () {
        /**
         * Main dashboard
         */
        Route::get('/', fn () => view('dashboard'))->name('dashboard');

        /**
         * Routes for IRC domain
         */
        Route::prefix('irc')->group(function () {
            Route::get('/', [IndexNickController::class, 'render'])->name('irc.index');

            Route::prefix('nicks')->group(function () {
                Route::get('/', ListNickController::class)->name('irc.nicks');
                Route::get('create', [CreateNickController::class, 'render'])->name('irc.nicks-create');
                Route::post('create', CreateNickController::class);
                Route::get('update/{id}', [UpdateNickController::class, 'render'])->name('irc.nicks-update');
                Route::post('update/{id}', UpdateNickController::class);
                Route::get('delete/{id}', [DeleteNickController::class, 'render'])->name('irc.nicks-delete');
                Route::post('delete/{id}', DeleteNickController::class);
            });

            Route::prefix('config')->group(function () {
                Route::get('/', ListConfigController::class)->name('irc.config');
                Route::get('create', [CreateConfigController::class, 'render'])->name('irc.config-create');
                Route::post('create', CreateConfigController::class);
                Route::get('update/{key}', [UpdateConfigController::class, 'render'])->name('irc.config-update');
                Route::post('update/{key}', UpdateConfigController::class);
                Route::get('delete/{key}', [DeleteConfigController::class, 'render'])->name('irc.config-delete');
                Route::post('delete/{key}', DeleteConfigController::class);
            });
        });

    }
);

/**
 * Add routes of Laravel Breeze authentication system
 */
require __DIR__.'/auth.php';
