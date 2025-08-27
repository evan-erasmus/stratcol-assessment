<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'order_number' => 'ORD'.uniqid(),
                'transaction_id' => null,
                'status' => 'completed',
                'total_amount' => 150.00,
                'currency_id' => 1,
                'return_amount' => 0.00,
                'exchange_rate' => 0.0808279,
                'placed_at' => now()->subDays(10),
            ],
            [
                'order_number' => 'ORD'.uniqid(),
                'transaction_id' => null,
                'status' => 'pending',
                'total_amount' => 200.00,
                'currency_id' => 2,
                'return_amount' => 0.00,
                'exchange_rate' => 0.0718710,
                'placed_at' => now()->subDays(5),
            ],
            [
                'order_number' => 'ORD'.uniqid(),
                'transaction_id' => null,
                'status' => 'canceled',
                'total_amount' => 300.00,
                'currency_id' => 3,
                'return_amount' => 300.00,
                'exchange_rate' => 0.0527032,
                'placed_at' => now()->subDays(2),
            ],
            [
                'order_number' => 'ORD'.uniqid(),
                'transaction_id' => null,
                'status' => 'canceled',
                'total_amount' => 300.00,
                'currency_id' => 4,
                'return_amount' => 300.00,
                'exchange_rate' => 0.0527032,
                'placed_at' => now()->subDays(2),
            ],
        ];

        foreach ($orders as $order) {
            $currency = Currency::where('id', $order['currency_id'])->first();

            Transaction::create([
                'reference' => 'TXN' . uniqid(),
                'account_id' => $order['currency_id'] % 2 == 0 ? 2 : 1,
                'amount' => $order['total_amount'],
                'type' => 'debit',
                'description' => "Purchase of {$currency->code} (Order #{$order['order_number']})",
            ]);

            $order['transaction_id'] = Transaction::latest()->first()->id;

            Order::updateOrCreate(
                $order
            );
        }
    }
}
