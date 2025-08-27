<?php

namespace App\Livewire;

use Livewire\Component;

class AccountDetails extends Component
{
    public array $account = [];

    public function mount() {
        $this->account = auth()->user()->accounts()
            ->where('account_number', request()->route('account_number'))
            ->first()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.account-details');
    }
}
