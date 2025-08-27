<div>
    <div class="grid auto-rows-max gap-4 md:grid-cols-4 text-center text-2xl">

        <div
            class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
            {{ $account['account_number'] }} - {{ ucfirst($account['status']) }}

            <div class="gap-4 flex flex-col items-center justify-center">
                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    R{{ number_format($account['balance'], 2) }}
                </div>
            </div>
        </div>
        <div
            class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
            {{ $account['account_number'] }} - {{ ucfirst($account['status']) }}

            <div class="gap-4 flex flex-col items-center justify-center">
                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    R{{ number_format($account['balance'], 2) }}
                </div>
            </div>
        </div>
        <div
            class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
            {{ $account['account_number'] }} - {{ ucfirst($account['status']) }}

            <div class="gap-4 flex flex-col items-center justify-center">
                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    R{{ number_format($account['balance'], 2) }}
                </div>
            </div>
        </div>
        <div
            class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-center justify-center">
            {{ $account['account_number'] }} - {{ ucfirst($account['status']) }}

            <div class="gap-4 flex flex-col items-center justify-center">
                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    R{{ number_format($account['balance'], 2) }}
                </div>
            </div>
        </div>
    </div>
</div>
