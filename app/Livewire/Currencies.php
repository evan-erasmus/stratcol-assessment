<?php

namespace App\Livewire;

use Livewire\Component;

class Currencies extends Component
{
    public array $currencies = [];

    public function mount()
    {
        $this->currencies = \App\Models\Currency::get()->toArray();
    }

    public function render()
    {
        return view('livewire.currencies');
    }
}
