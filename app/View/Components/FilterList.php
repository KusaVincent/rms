<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

final class FilterList extends Component
{
    /**
     * @param  Collection<int, Property>  $items
     */
    public function __construct(public string $title, public Collection $items, public string $idPrefix = 'item') {}

    public function render(): View
    {
        return view('components.filter-list');
    }
}
