<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FilterList extends Component
{
    public string $title;
    public $items;
    public string $idPrefix;

    public function __construct($title, $items, $idPrefix = 'item')
    {
        $this->title = $title;
        $this->items = $items;
        $this->idPrefix = $idPrefix;
    }

    public function render(): View|Closure|string
    {
        return view('components.filter-list');
    }
}
