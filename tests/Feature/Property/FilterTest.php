<?php

test('filter items by type or location', function () {
    $this->artisan('db:seed')->run();

    $response = $this->get('/?selectedTypes[0]=1');
    $response->assertStatus(200);
    $response->assertViewHas('items', function ($items) {
        return $items->count() === 1 && $items->first()->type_name === 'Studio';
    });

    $response = $this->get('/?selectedLocations[0]=1');
    $response->assertStatus(200);
    $response->assertViewHas('items', function ($items) {
        return $items->count() === 1 && $items->first()->town_city === '"Ellaside"';
    });
});
