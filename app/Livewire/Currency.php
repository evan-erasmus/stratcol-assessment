<?php

namespace App\Livewire;

use App\Jobs\ProcessOrder;
use App\Models\Currency as CurrencyModel;
use App\Models\Order as OrderModel;
use App\Models\Transaction as TransactionModel;
use Exception;
use Livewire\Component;

class Currency extends Component
{
    public array $currency = [];

    public ?float $total_cost = 0;

    public ?float $total_cost_without_surcharge = 0;

    public ?float $exchange = null;

    public ?float $zar = null;

    public function mount()
    {
        $this->currency = CurrencyModel::where('code', request()->route('currency'))->first()?->toArray() ?? [];
    }

    public function placeOrder()
    {
        $this->validate([
            'total_cost' => 'required|numeric|min:1',
        ]);

        if ($this->total_cost <= 0) {
            $this->addError('zar', 'Invalid order amount. Please enter a valid amount.');

            return;
        }
        try {
            $account_id = session()->get('selected_account_id');
        } catch (Exception $e) {
            $this->addError('zar', 'No account selected. Please select an account to place the order.');

            return;
        }

        if (! $account_id) {
            $this->addError('zar', 'No account selected. Please select an account to place the order.');

            return;
        }

        $account = auth()->user()->accounts()->where('id', $account_id)->first();

        if ($this->total_cost > $account->balance) {
            $this->addError('zar', 'Insufficient funds in the selected account. Please select an account with sufficient balance to place the order.');

            return;
        }

        if (! $account) {
            $this->addError('zar', 'Selected account not found. Please select a valid account to place the order.');

            return;
        }

        $order_number = uniqid('ORD');

        $transaction = TransactionModel::create([
            'reference' => uniqid('TXN'),
            'account_id' => $account->id,
            'amount' => $this->total_cost,
            'type' => 'debit',
            'description' => 'Purchase of '.$this->currency['code'].' (Order #'.$order_number.')',
        ]);

        $order = OrderModel::create([
            'transaction_id' => $transaction->id,
            'currency_id' => $this->currency['id'],
            'order_number' => $order_number,
            'status' => 'pending',
            'total_amount' => $this->total_cost,
            'return_amount' => $this->total_cost_without_surcharge,
            'exchange_rate' => $this->currency['exchange_rate'],
            'discount_percentage' => $this->currency['discount_percentage'],
            'placed_at' => now(),
        ]);

        $account->balance -= $this->total_cost;
        $account->save();

        $this->dispatch('accountBalanceUpdated');

        ProcessOrder::dispatch($order);

        session()->flash('message', 'Order placed successfully!');
    }

    public function recalculateFromZar()
    {
        $this->total_cost_without_surcharge = $this->zar;
        $this->total_cost = $this->zar * (1 + $this->currency['surcharge_percentage'] / 100);
        $this->total_cost -= $this->total_cost * ($this->currency['discount_percentage'] / 100);
        $this->exchange = $this->zar * $this->currency['exchange_rate'];
    }

    public function recalculateFromExchange()
    {
        $this->total_cost_without_surcharge = $this->exchange / $this->currency['exchange_rate'];
        $this->total_cost = $this->total_cost_without_surcharge * (1 + $this->currency['surcharge_percentage'] / 100);
        $this->total_cost -= $this->total_cost * ($this->currency['discount_percentage'] / 100);
        $this->zar = $this->total_cost_without_surcharge;
    }

    public function render()
    {
        return view('livewire.currency');
    }
}
