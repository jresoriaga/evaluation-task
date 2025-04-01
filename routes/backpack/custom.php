<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::get('deal/account-count/{account_id}', function($account_id) {
        $count = \App\Models\Deal::where('account_id', $account_id)->count();
        return response()->json(['count' => $count]);
    })->name('deal.accountCount');

    Route::crud('iso', 'IsoCrudController');
    Route::crud('sic', 'SicCrudController');
    Route::crud('account', 'AccountCrudController');
    Route::crud('deal', 'DealCrudController');
    Route::crud('setting', 'SettingCrudController');
}); 

// -----------------------------
// Backpack Permission Manager Routes
// -----------------------------
Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
         (array) config('backpack.base.web_middleware', 'web'),
         (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'Backpack\PermissionManager\app\Http\Controllers',
], function () {
    Route::crud('user', 'UserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('permission', 'PermissionCrudController');
});

// this should be the absolute last line of this file