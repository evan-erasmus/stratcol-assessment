<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
})->name('home');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/exchange', function () {
    $currencies = Currency::all();
    $currency_count = $currencies->count();

    return view('exchange', compact('currencies', 'currency_count'));
})
    ->middleware(['auth', 'verified'])
    ->name('exchange');

Route::get('/orders', function () {
    $orders = auth()->user()->orders()
        ->get()
        ->toArray();

    return view('orders', compact('orders'));
})
    ->middleware(['auth', 'verified'])
    ->name('orders');

Route::get('/account/{account_number}', function ($account_number) {
    $account = auth()->user()->accounts()
        ->where('account_number', $account_number)
        ->firstOrFail()
        ->toArray();

    if (! $account) {
        return redirect()->route('dashboard')->with('error', 'Account not found');
    }

    return view('account', compact('account'));
})
    ->middleware(['auth', 'verified'])
    ->name('account');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
