<div wire:poll.5s="loadOrders" class="flex flex-col gap-4 text-center text-2xl w-full overflow-y-auto">
    @if( count($orders) < 1 )
        <div class="text-center text-lg text-gray-500 dark:text-gray-400">
            No orders found.
        </div>
    @endif
    @foreach( $orders as $order )
        <div
            class="relative p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 grid auto-rows-min md:grid-cols-3 text-center text-2xl">
            <div class="gap-4 flex flex-col items-start justify-between">
                <div class="gap-4 flex flex-row items-center justify-start">
                    @if($order['status'] == 'completed')
                        <x-heroicon-o-check-circle class="w-5 h-5 text-green-500"/>
                    @elseif($order['status'] == 'cancelled')
                        <x-heroicon-o-x-circle class="w-5 h-5 text-red-500"/>
                    @elseif($order['status'] == 'pending')
                        <x-heroicon-o-clock class="w-5 h-5 text-yellow-500"/>
                    @endif
                    <span
                        class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $order['order_number'] }}</span>
                </div>
                <div class="gap-4 text-lg font-semibold flex flex-col items-start justify-start">
                    {{ $order['placed_at'] }}
                </div>
            </div>
            <div class="gap-4 flex flex-col items-center justify-center">
                <div class="gap-2 flex items-center">
                    <span
                        class="text-xl flex flex-row gap-4 font-semibold text-gray-800 dark:text-gray-200 items-center">
                        <img src="https://flagcdn.com/za.svg" alt="{{ $order['currency']['code'] }}  Flag"
                             class="w-12"/>
                        ZAR
                    </span>
                    <x-heroicon-o-arrow-right class="w-5 h-5 text-gray-800 dark:text-gray-200"/>
                    <span
                        class="text-xl flex flex-row gap-4 font-semibold text-gray-800 dark:text-gray-200 items-center">
                        <img src="https://flagcdn.com/{{ $order['currency']['country_code_short'] }}.svg"
                             alt="{{ $order['currency']['code'] }}  Flag" class="w-12"/>
                        {{ $order['currency']['code'] }}
                    </span>
                </div>
            </div>
            <div class="gap-4 flex flex-col items-start justify-between">
                <div class="w-full gap-4 flex flex-col items-start justify-start">
                    <div
                        class="w-full flex flex-row gap-4 justify-between text-sm font-semibold text-gray-800 dark:text-gray-200">
                        <span>Paid:</span>
                        <span>R{{ number_format($order['total_amount'], 2) }}</span>
                    </div>
                    <div
                        class="w-full flex flex-row gap-4 justify-between text-sm font-semibold text-gray-800 dark:text-gray-200">
                        <span>Returned (Less Surcharge):</span>
                        <span>R{{ number_format($order['return_amount'], 2) }}</span>
                    </div>
                    <div
                        class="w-full flex flex-row gap-4 justify-between text-sm font-semibold text-gray-800 dark:text-gray-200">
                        <span>Surcharge Percentage:</span>
                        <span>{{ number_format($order['currency']['surcharge_percentage'], 2) }}%</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
