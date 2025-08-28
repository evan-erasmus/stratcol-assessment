@php use Carbon\Carbon; @endphp
<div class="flex flex-col gap-4 text-center text-2xl w-full overflow-y-auto">
    @if( count($transactions) < 1 )
        <div class="text-center text-lg text-gray-500 dark:text-gray-400">
            No transactions found.
        </div>
    @endif
    @foreach( $transactions as $transaction )
        <div class="relative p-4 {{ $transaction['type'] == 'credit' ? 'bg-green-500/15' : 'bg-red-500/15' }} w-full bg-opacity-25 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 flex flex-col items-start justify-start">
            <div class="gap-4 w-full flex flex-row items-center justify-between text-left">
                <div class="text-lg text-gray-800 dark:text-gray-200 text-left">
                    {{ ucfirst($transaction['reference']) }}
                </div>
                <div class="text-lg w-full text-gray-800 dark:text-gray-200 text-right">
                    {{ ucfirst($transaction['description']) }}
                </div>
            </div>
            <div class="gap-4 w-full flex flex-row items-center justify-between">
                <div class="text-sm text-gray-800 dark:text-gray-200">
                    {{ Carbon::parse($transaction['created_at'])->format('Y-m-d H:i:s') }}
                </div>
                <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    {{ $transaction['type'] == 'credit' ? '+' : '-' }} R{{ number_format($transaction['amount'], 2) }}
                </div>
            </div>
        </div>
    @endforeach
</div>
