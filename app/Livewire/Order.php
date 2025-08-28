<?php

namespace App\Livewire;

use Livewire\Component;

class Order extends Component
{
    public array $order = [];

    public function mount()
    {
        $this->order = auth()->user()->accounts()
            ->where('account_number', request()->route('account_number'))
            ->first()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.order');
    }
}
