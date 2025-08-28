<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'user_id' => 1,
                'account_number' => Account::generateAccountNumber(),
                'balance' => 0,
                'status' => 'active',
            ],
            [
                'user_id' => 1,
                'account_number' => Account::generateAccountNumber(),
                'balance' => 0,
                'status' => 'active',
            ],
        ];

        foreach ($accounts as $account) {
            Account::updateOrCreate(
                ['account_number' => $account['account_number']],
                $account
            );
        }
    }
}
