<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\PropertyFilterAction;
use App\Helpers\LogHelper;
use App\Traits\Limitable;
use App\Traits\Selectable;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Url;
use Livewire\Component;

final class Search extends Component
{
    use Limitable, Selectable;

    #[Url(except: '')]
    public string $search = '';

    public Collection $results;

    public function updatedSearch(): void
    {

        Cache::forget('search_'.session()->getId());

        $this->results = new Collection();

        $criteria = [
            'limit' => $this->limit(),
            'selects' => $this->selects(),
            'relations' => $this->relations(),
        ];

        if ($this->search === '') {
            $this->redirectRoute('properties', navigate: true);

            return;
        }

        try {
            Cache::set('search_'.session()->getId(), $this->search, now()->addMinutes(5));

            $this->results = PropertyFilterAction::execute($criteria);

            LogHelper::error("Search for: {$this->search}");

            $this->dispatch('search-results', $this->results);
        } catch (Exception $e) {
            $this->results = new Collection();
            ToastMagic::error('An error occurred while searching. Please try again.');
            LogHelper::error("Search failed for query '{$this->search}': {$e->getMessage()}");
        }
    }
}
