<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'code' => 'USD',
                'name' => 'United States Dollar',
                'symbol' => '$',
                'surcharge_percentage' => 7.5,
                'exchange_rate' => 0.0808279,
                'country_code_short' => 'us',
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound',
                'symbol' => '£',
                'surcharge_percentage' => 5,
                'exchange_rate' => 0.0527032,
                'country_code_short' => 'gb',
            ],
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'surcharge_percentage' => 5,
                'exchange_rate' => 0.0718710,
                'country_code_short' => 'eu',
            ],
            [
                'code' => 'KES',
                'name' => 'Kenyan Shilling',
                'symbol' => 'KSh',
                'surcharge_percentage' => 2.5,
                'exchange_rate' => 7.81498,
                'country_code_short' => 'ke',
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency['code']],
                $currency
            );
        }
    }
}
