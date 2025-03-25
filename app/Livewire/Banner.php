<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Http\Request;

class Banner extends Component
{
    public string $bannerHeight;
    public string $backgroundImage;

    public function mount(Request $request): void
    {
        [$this->bannerHeight, $this->backgroundImage] = $this->determineBannerAttributes($request->path());
    }

    private function determineBannerAttributes(string $path): array
    {
        return match ($path) {
            '/' => ['h-[75vh]', asset('storage/banner-2.jpg')],
            'properties' => ['h-[50vh]', asset('storage/banner.jpg')],
            default => ['h-[25vh]', asset('storage/breadcrumb.jpg')],
        };
    }

    public function render():View
    {
        return view('livewire.banner');
    }
}
