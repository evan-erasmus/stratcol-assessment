<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Transaction;
use Livewire\Component;

class AccountDetails extends Component
{
    public array $account = [];

    public $amount = null;

    public function mount()
    {
        $this->loadAccount();
    }

    public function loadAccount($account = null)
    {
        if ($account) {
            $this->account = $account->toArray();

            return;
        }

        $this->account = auth()->user()->accounts()
            ->where('account_number', request()->route('account_number'))
            ->first()
            ->toArray();
    }

    public function addFunds()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $account = Account::where('account_number', $this->account['account_number'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Transaction::create([
            'reference' => 'TXN'.uniqid(),
            'account_id' => $account->id,
            'amount' => $this->amount,
            'type' => 'credit',
            'description' => 'Deposit to account '.$account->account_number,
        ]);

        $account->balance += $this->amount;
        $account->save();

        $this->dispatch('transactionCreated', ['account_number' => $account->account_number]);
        $this->loadAccount($account);
        $this->amount = null;

        session()->flash('message', 'Funds added successfully!');
    }

    public function render()
    {
        return view('livewire.account-details');
    }
}
