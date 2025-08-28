<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Transactions extends Component
{
    public array $transactions = [];

    public function mount()
    {
        $this->loadTransactions();
    }

    public function loadTransactions($account_number = null)
    {
        if (! $account_number) {
            $account_number = request()->route('account_number');
        }

        $this->transactions = auth()->user()->accounts()
            ->where('account_number', $account_number)
            ->first()
            ?->transactions()
            ->latest()
            ->get()
            ->toArray();
    }

    #[On('transactionCreated')]
    public function refreshTransactions($account_number = null)
    {
        $this->loadTransactions($account_number);
    }

    public function render()
    {
        return view('livewire.transactions');
    }
}
