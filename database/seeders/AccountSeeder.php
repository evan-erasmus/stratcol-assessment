<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'user_id'        => 1,
                'account_number' => 'ACC123456',
                'balance'        => 10000.00,
                'status'         => 'active',
            ],
            [
                'user_id'        => 1,
                'account_number' => 'ACC654321',
                'balance'        => 2500.00,
                'status'         => 'active',
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
