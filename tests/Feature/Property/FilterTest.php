<?php

declare(strict_types=1);

test('filter items by type or location', function (): void {
    $this->artisan('db:seed')->run();

    $response = $this->get('/?selectedTypes[0]=1');
    $response->assertStatus(200);
    $response->assertViewHas('items', fn ($items): bool => $items->count() === 1 && $items->first()->type_name === 'Studio');

    $response = $this->get('/?selectedLocations[0]=1');
    $response->assertStatus(200);
    $response->assertViewHas('items', fn ($items): bool => $items->count() === 1 && $items->first()->town_city === '"Ellaside"');
});
