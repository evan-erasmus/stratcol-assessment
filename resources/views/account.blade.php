<x-layouts.app :title="__('Account Details')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl overflow-auto">
        @livewire('account-details')
        @livewire('transactions')
    </div>
</x-layouts.app>
