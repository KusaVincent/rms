<main class="flex-grow px-6">
    <livewire:banner />

    @if (Request::is('/'))
        <x-layouts.grid>
            <livewire:sidebar />
            <livewire:property />
        </x-layouts.grid>
    @elseif(Request::is('properties'))
        <x-layouts.grid>
            <livewire:property />
        </x-layouts.grid>
    @elseif(Request::is('property-details/*'))
        <livewire:detail :id="Request::route('id')" />
    @elseif(Request::is('contact'))
        <livewire:contact />
    @elseif(Request::is('about'))
        <x-layouts.stack>
            <livewire:about />
            <livewire:founder />
            <livewire:start />
        </x-layouts.stack>
    @endif
</main>
