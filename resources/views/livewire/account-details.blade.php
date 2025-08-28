<div class="grid auto-rows-max gap-4 md:grid-cols-1 text-center text-2xl w-full">
    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
        {{ $account['account_number'] }} - {{ ucfirst($account['status']) }}
        <div class="gap-4 flex flex-col items-center justify-center">
            <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                R{{ number_format($account['balance'], 2) }}
            </div>
        </div>
    </div>
    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
        <h2 class="text-center text-2xl mb-4 text-gray-800 dark:text-gray-200">
        Add Funds
        </h2>
        <div class="flex flex-row justify-around items-center gap-4">
        <input type="number" step="0.01" min="1"
            wire:model="amount"
            class="text-lg w-1/2 p-2 rounded border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
            placeholder="Enter amount">
        <button wire:click="addFunds"
            class="text-center px-4 py-2 w-1/2 bg-blue-600 text-white rounded text-lg">
            Add
        </button>
        </div>
        @error('amount')
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
        @if(session()->has('message'))
            <p class="text-green-600 text-sm mt-2">{{ session('message') }}</p>
        @endif
    </div>
</div>
