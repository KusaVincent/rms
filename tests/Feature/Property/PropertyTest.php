<?php

declare(strict_types=1);

test('the properties page is loading', function (): void {
    $response = $this->get('/properties');

    $response->assertStatus(200);
});
