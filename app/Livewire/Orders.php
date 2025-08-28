<?php

namespace App\Livewire;

use App\Models\Currency as CurrencyModel;
use Livewire\Component;

class Orders extends Component
{
    public array $orders = [];

    public function mount()
    {
        $this->loadOrders();
    }

    public function render()
    {
        return view('livewire.orders');
    }

    public function loadOrders()
    {
        $this->orders = auth()->user()
            ->orders()
            ->latest()
            ->get()
            ->map(function ($order) {
                $order->currency = CurrencyModel::find($order->currency_id);

                return $order;
            })
            ->toArray();
    }
}
