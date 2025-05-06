<?php

declare(strict_types=1);

test('the homepage is loading', function (): void {
    $response = $this->get('/');

    $response->assertStatus(200);
    $this->assertTrue(Route::has('home'));
    $response->assertViewIs('tenant-entry');
});
