<div class="grid auto-rows-min gap-4 md:grid-cols-5">
    <div></div>
    <div
        class="col-span-3 relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
        @error('zar')
        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
        @if(session()->has('message'))
            <p class="text-green-600 text-sm mt-2">{{ session('message') }}</p>
        @endif
        <div class="py-4 gap-4 flex flex-col items-center justify-center">
            <div class="gap-2 flex items-center">
                <span
                    class="text-xl flex flex-row gap-4 font-semibold text-gray-800 dark:text-gray-200 items-center">
                    <input type="number" step="0.01" min="1" max="9999999"
                           wire:model="zar"
                           wire:change="recalculateFromZar"
                           class="text-lg w-full p-2 rounded border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                           placeholder="Enter amount">
                    <img src="https://flagcdn.com/za.svg" alt="ZAR Flag" class="w-12"/>
                    ZAR
                </span>
                <x-heroicon-o-arrow-right class="w-5 h-5 text-gray-800 dark:text-gray-200 items-center"/>
                <span
                    class="text-xl flex flex-row gap-4 font-semibold text-gray-800 dark:text-gray-200 items-center">
                    <img src="https://flagcdn.com/{{ $this->currency['country_code_short'] }}.svg"
                         alt="{{ $this->currency['code'] }} Flag" class="w-12"/>

                    {{ $this->currency['code'] }}
                    <input type="number" step="0.01" min="1" max="9999999"
                           wire:model="exchange"
                           wire:change="recalculateFromExchange"
                           class="text-lg w-full p-2 rounded border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                           placeholder="Enter amount">
                </span>
            </div>
        </div>
        <div class="gap-4 flex flex-col items-start justify-between">
            <div class="w-full gap-4 flex flex-col items-start justify-start">
                <div
                    class="w-full flex flex-row gap-4 justify-between text-sm font-semibold text-gray-800 dark:text-gray-200">
                    <span>Total cost:</span>
                    <span>R{{ number_format($this->total_cost, 2) }}</span>
                </div>
                <div
                    class="w-full flex flex-row gap-4 justify-between text-sm font-semibold text-gray-800 dark:text-gray-200">
                    <span>Returned (Less Surcharge):</span>
                    <span>{{ $this->currency['symbol'] }}{{ number_format($this->exchange, 2) }}</span>
                </div>
                <div
                    class="w-full flex flex-row gap-4 justify-between text-sm font-semibold text-gray-800 dark:text-gray-200">
                    <span>Surcharge Percentage:</span>
                    <span>{{ number_format($this->currency['surcharge_percentage'], 2) }}%</span>
                </div>
                <div class="py-4 flex flex-row justify-around items-center gap-4 w-full">
                    <button wire:click="placeOrder"
                            class="text-center px-4 py-2 w-full bg-blue-600 text-white rounded text-lg pointer"
                            @if($this->total_cost <= 0) disabled class="opacity-50 cursor-not-allowed" @endif>
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div></div>
</div>
