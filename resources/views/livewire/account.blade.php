<div>
    @if( $this->selectedAccount )
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div></div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
                <div class="gap-4 flex flex-col items-center justify-center">
                    <div class="mb-4">
                        <select wire:model.live="selectedAccountId" class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white p-2">
                            @foreach($accounts as $account)
                                <option value="{{ $account['id'] }}">
                                    {{ $account['account_number'] }} - {{ ucfirst($account['status']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-md font-semibold text-gray-800 dark:text-gray-200">ZAR (R)</div>
                    <img src="https://flagcdn.com/za.svg" alt="ZA Flag" class="w-24"/>
                    <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Balance: {{ $this->selectedAccount['balance'] }}
                    </div>
                </div>
                <div></div>
            </div>
        </div>
    @endif
</div>
