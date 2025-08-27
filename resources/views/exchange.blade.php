<x-layouts.app :title="__('Exchange')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl overflow-auto">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1 text-center text-2xl">
            Your Account
        </div>
        @livewire('account')
        <div class="grid auto-rows-min gap-4 md:grid-cols-1 text-center text-2xl">
            Pick a currency to start an exchange order
        </div>
        @livewire('currencies')
    </div>
</x-layouts.app>
