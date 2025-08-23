<main class="flex-grow px-6">
    <livewire:banner />

    @if (Route::currentRouteName() === 'home')
        <x-layouts.grid>
            <livewire:sidebar />
            <livewire:property />
        </x-layouts.grid>
    @elseif(Route::currentRouteName() === 'properties')
        <x-layouts.grid>
            <livewire:property />
        </x-layouts.grid>
    @elseif(Route::currentRouteName() === 'details')
        <livewire:detail :slug="Request::route('slug')" />
    @elseif(Route::currentRouteName() === 'contact')
        <livewire:contact />
    @elseif(Route::currentRouteName() === 'about')
        <x-layouts.stack>
            <livewire:about />
            <livewire:founder />
            <livewire:start />
        </x-layouts.stack>
    @endif
</main>
