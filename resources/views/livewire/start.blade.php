<x-ui.statistics-section>
    <x-ui.stat-box icon="flaticon-badge" count="{{ number_format($sale) }}" label="Lines of Sale" />
    <x-ui.stat-box icon="flaticon-tag" count="{{ number_format($listings) }}" label="Listings For Rent" />
    <x-ui.stat-box icon="flaticon-call-center-agent" count="{{ number_format($agents) }}" label="Agents" />
</x-ui.statistics-section>
