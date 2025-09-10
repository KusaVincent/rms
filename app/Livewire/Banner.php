<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

final class Banner extends Component
{
    public string $bannerHeight;

    public string $backgroundImage;

    public function mount(Route $route): void
    {
        [$this->bannerHeight, $this->backgroundImage] = $this->determineBannerAttributes($route::currentRouteName());
    }

    /**
     * @return array<string>
     */
    private function determineBannerAttributes(string $path): array
    {
        return match ($path) {
            'home' => ['h-[75vh]', config('app.media') . 'storage/banner-2.jpg'],
            'properties' => ['h-[50vh]', config('app.media') . 'storage/banner.jpg'],
            default => ['h-[25vh]', config('app.media') . 'storage/breadcrumb.jpg'],
        };
    }
}
