<x-layouts.app :title="__('Exchange')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl overflow-auto">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1 text-center text-2xl">
            Your Account
        </div>
        @livewire('account')
        <div class="grid auto-rows-min gap-4 md:grid-cols-1 text-center text-2xl">
            Pick a currency to start an exchange order
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            @foreach( $currencies as $currency )
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
                    <div class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $currency['code'] }} ({{ $currency['symbol'] }})</div>
                    <img src="https://flagcdn.com/{{ $currency['country_code_short'] }}.svg" alt="{{ $currency['code'] }}  Flag" class="w-24"/>
                    <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">R{{ number_format(1.0 / $currency['exchange_rate'], 2) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
