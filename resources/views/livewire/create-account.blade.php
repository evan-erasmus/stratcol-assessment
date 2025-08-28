<div @click.away="open = false"
    class="bg-white dark:bg-zinc-800 p-6 rounded-lg w-96">
    <h2 class="text-center text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Select Account
    </h2>
    <select wire:model="selectedAccountId"
        class="w-full p-2 rounded border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white mb-4">
        @foreach ($accounts as $account)
            <option value="{{ $account->account_number }}">
                {{ $account->account_number }} - {{ ucfirst($account->status) }}
            </option>
        @endforeach
    </select>
    <div class="flex justify-between gap-2">
        <button @click="open = false"
            class="text-center w-full px-4 py-2 bg-red-600 text-white rounded">
            Cancel
        </button>
        <button wire:click="goToAccount"
            class="text-center w-full px-4 py-2 bg-blue-600 text-white rounded">
            Go
        </button>
    </div>
    <h2 class="m-4 text-center text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Or
    </h2>
    <div class="flex justify-center gap-2 w-full">
        <button wire:click="createAccount"
            class="text-center px-4 py-2 bg-green-600 text-white rounded w-full">
            Create Account
        </button>
    </div>
</div>
