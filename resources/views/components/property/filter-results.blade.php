@props(['title', 'filterResults', 'gridCols', 'design'])

<x-property.results
    gridCols="lg:grid-cols-5"
    design="lg:col-span-12"
    :results="$filterResults"
    title="{{ count($filterResults) }} search results found"
/>
