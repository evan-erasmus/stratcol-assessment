<?php

namespace App\Livewire;

use App\Models\Account as AccountModel;
use Livewire\Component;

class Account extends Component
{
    public array $accounts = [];

    public ?array $selectedAccount = null;

    public ?int $selectedAccountId = null;

    public function mount()
    {
        $this->accounts = auth()->user()->accounts()
            ->get()
            ->map(function ($account) {
                return [
                    'id' => $account->id,
                    'user_id' => $account->user_id,
                    'account_number' => $account->account_number,
                    'balance' => 'R'.number_format($account->balance, 2),
                    'status' => $account->status,
                    'opened_at' => $account->opened_at,
                ];
            })->toArray();
        $this->selectedAccount = $this->accounts[0] ?? null;
        $this->selectedAccountId = $this->selectedAccount['id'] ?? null;
    }

    public function updatedSelectedAccountId($accountId)
    {
        $account = AccountModel::find($accountId);

        if ($account) {
            $this->selectedAccount = [
                'id' => $account->id,
                'user_id' => $account->user_id,
                'account_number' => $account->account_number,
                'balance' => 'R'.number_format($account->balance, 2),
                'status' => $account->status,
                'opened_at' => $account->opened_at,
            ];

            $this->dispatch('account-updated');
        }
    }

    public function refreshAccount()
    {
        if ($this->selectedAccountId) {
            $this->updatedSelectedAccountId($this->selectedAccountId);
        }
    }

    public function render()
    {
        return view('livewire.account');
    }
}
