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

    public string $redirectRoute = 'home';

    public function updatedSearch(): void
    {
        $sessionId = session()->getId();
        $user = auth()->user();
        $this->results = new Collection();

        Cache::forget("search_{$sessionId}");

        $criteria = [
            'limit' => $this->limit(),
            'selects' => $this->selects(),
            'relations' => $this->relations(),
        ];

        if (empty($this->search)) {
            $this->redirectRoute($this->redirectRoute, navigate: true);
            return;
        }

        try {
            $start = microtime(true);

            Cache::set("search_{$sessionId}", $this->search, now()->addMinutes(5));

            $this->results = PropertyFilterAction::execute($criteria);

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Search executed successfully.',
                request: request(),
                additionalData: [
                    'component' => 'Search Livewire Component',
                    'duration_ms' => $duration,
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'search_query' => $this->search,
                    'criteria' => $criteria,
                    'results_count' => $this->results->count(),
                    'session_id' => $sessionId,
                ]
            );

            $this->dispatch('search-results', $this->results);
        } catch (Exception $e) {
            $this->results = new Collection();

            ToastMagic::error('An error occurred while searching. Please try again.');

            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'Search Livewire Component',
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'search_query' => $this->search,
                    'criteria' => $criteria,
                    'session_id' => $sessionId,
                ]
            );
        }
    }
}
