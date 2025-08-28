<div>
    <div
        class="relative p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 gap-4 grid auto-rows-min md:grid-cols-1 text-center text-2xl">
        <div class="gap-4 flex flex-col items-start justify-between">
            <div class="gap-4 flex
                    flex-col items-start justify-start text-2xl font-semibold text-gray-800 dark:text-gray-200">
                <h2 class="text-3xl font-bold mb-4">Order Confirmation</h2>
                <p>Thank you for your order! Here are the details of your currency exchange:</p>
                <ul class="list-disc list-inside mt-4">
                    <li><strong>Order Number:</strong> {{ $order['order_number'] }}</li>
                    <li><strong>Placed At:</strong> {{ $order['placed_at'] }}</li>
                    <li><strong>Status:</strong>
                        @if($order['status'] == 'completed')
                            <span class="text-green-500 font-semibold">Completed</span>
                        @elseif($order['status'] == 'cancelled')
                            <span class="text-red-500 font-semibold">Cancelled</span>
                        @elseif($order['status'] == 'pending')
                            <span class="text-yellow-500 font-semibold">Pending</span>
                        @endif
                    </li>
                    <li><strong>From Currency:</strong> ZAR (R)
                        <img src="https://flagcdn.com/za.svg" alt="ZA Flag" class="w-6 inline"/>
                    </li>
                    <li><strong>To Currency:</strong> {{ $order['currency']['code'] }}
                        ({{ $order['currency']['symbol'] }})
                        <img src="https://flagcdn.com/{{ $order['currency']['country_code_short'] }}.svg"
                             alt="{{ $order['currency']['code'] }} Flag" class="w-6 inline"/>
                    </li>
                    <li><strong>Total Paid:</strong> R{{ number_format($order['total_amount'], 2) }}</li>
                    <li><strong>Amount Returned (Less Surcharge):</strong>
                        R{{ number_format($order['return_amount'], 2) }}</li>
                    <li><strong>Surcharge Percentage:</strong>
                        {{ number_format($order['currency']['surcharge_percentage'], 2) }}%
                    </li>
                </ul>
                <p class="mt-4">If you have any questions or need further assistance, please don't hesitate to contact
                    our support team.</p>
                <p class="mt-4">Best regards,<br/>The Currency Exchange Team</p>
            </div>
        </div>
    </div>
</div>
