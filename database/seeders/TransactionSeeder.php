<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'reference' => 'TXN' . uniqid(),
                'account_id' => 1,
                'amount' => 5000.00,
                'type' => 'credit',
                'description' => 'Deposit to account ACC123456',
            ],
            [
                'reference' => 'TXN' . uniqid(),
                'account_id' => 1,
                'amount' => 5000.00,
                'type' => 'credit',
                'description' => 'Deposit to account ACC123456',
            ],
            [
                'reference' => 'TXN' . uniqid(),
                'account_id' => 2,
                'amount' => 2500.00,
                'type' => 'credit',
                'description' => 'Deposit to account ACC654321',
            ],
        ];

        foreach ($transactions as $transaction) {
            Transaction::updateOrCreate(
                $transaction
            );
        }
    }
}
