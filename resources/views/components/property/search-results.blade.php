@props(['title', 'searchResults', 'gridCols', 'design'])

<x-property.results
    gridCols="lg:grid-cols-5"
    design="lg:col-span-12"
    :results="$searchResults"
    title="{{ count($searchResults) }} search results found"
/>
