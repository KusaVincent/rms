<div>
    @php
        $saleStarts     = (int) $sales;
        $agentsStarts   = (int) $agents;
        $listingsStarts = (int) $listings;
    @endphp

    @if($saleStarts > 0 || $listingsStarts > 0 || $agentsStarts > 0)
        <x-ui.statistics-section>
            @if($saleStarts > 0)
                <x-ui.stat-box icon="flaticon-badge" count="{{ number_format($saleStarts) }}" label="Lines of Sale" />
            @endif

            @if($listingsStarts > 0)
                <x-ui.stat-box icon="flaticon-tag" count="{{ number_format($listingsStarts) }}" label="Listings For Rent" />
            @endif

            @if($agentsStarts > 0)
                <x-ui.stat-box icon="flaticon-call-center-agent" count="{{ number_format($agentsStarts) }}" label="Agents" />
            @endif
        </x-ui.statistics-section>
    @endif
</div>
