@php
    $default_account = auth()->user()->accounts()->first()->account_number;
    $selectedAccountId = $default_account;
@endphp
<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1 text-center text-2xl">
            Welcome, what would you like to do?
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a href="{{ route('orders') }}">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
                    <x-heroicon-o-document-currency-dollar class="h-16 w-16 text-gray-800 dark:text-gray-200"/>
                    <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        View Orders
                    </div>
                </div>
            </a>
            <a href="{{ route('exchange') }}">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
                    <x-heroicon-o-arrows-up-down class="h-16 w-16 text-gray-800 dark:text-gray-200"/>
                    <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Exchange Currency
                    </div>
                </div>
            </a>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center cursor-pointer"
                x-data="{ open: false }" @click="open = true">
                <x-heroicon-o-credit-card class="h-16 w-16 text-gray-800 dark:text-gray-200"/>
                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Manage Accounts
                </div>
                <div x-show="open" x-cloak
                    class="fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                    @livewire('create-account')
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
