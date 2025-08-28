<?php

namespace Database\Seeders;

use App\Models\Account as AccountModel;
use App\Models\Transaction;
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
                'reference' => 'TXN'.uniqid(),
                'account_id' => 1,
                'amount' => 5000.00,
                'type' => 'credit',
                'description' => 'Deposit to account '.AccountModel::find(1)->account_number,
            ],
            [
                'reference' => 'TXN'.uniqid(),
                'account_id' => 1,
                'amount' => 5000.00,
                'type' => 'credit',
                'description' => 'Deposit to account '.AccountModel::find(1)->account_number,
            ],
            [
                'reference' => 'TXN'.uniqid(),
                'account_id' => 2,
                'amount' => 2500.00,
                'type' => 'credit',
                'description' => 'Deposit to account '.AccountModel::find(2)->account_number,
            ],
        ];

        foreach ($transactions as $transaction) {
            Transaction::updateOrCreate(
                $transaction
            );
        }
    }
}
