<x-layouts.app :title="__('Account Details')">
    <div class="flex h-full w-full flex-1 flex-row gap-4 rounded-xl overflow-hidden">
            @livewire('account-details')
            @livewire('transactions')
    </div>
</x-layouts.app>
