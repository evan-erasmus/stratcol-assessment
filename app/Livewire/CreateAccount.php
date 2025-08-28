<?php

namespace App\Livewire;

use App\Models\Account as AccountModel;
use Livewire\Component;

class CreateAccount extends Component
{
    public $accounts;

    public $selectedAccountId;

    public function mount($selectedAccountId = null)
    {
        $this->accounts = auth()->user()->accounts()->get();
        $this->selectedAccountId = $selectedAccountId ?? optional($this->accounts->first())->account_number;
    }

    public function createAccount()
    {
        $account = auth()->user()->accounts()->create([
            'account_number' => AccountModel::generateAccountNumber(),
            'balance' => 0,
            'status' => 'active',
            'opened_at' => now(),
        ]);

        $this->accounts = auth()->user()->accounts()->get();
        $this->selectedAccountId = $account->account_number;
    }

    public function goToAccount()
    {
        return redirect()->to('/account/'.$this->selectedAccountId);
    }

    public function render()
    {
        return view('livewire.create-account');
    }
}
