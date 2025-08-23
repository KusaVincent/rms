<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Negotiable extends Component
{
    public function render(): View
    {
        return view('components.negotiable');
    }
}
