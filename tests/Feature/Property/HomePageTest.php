<?php

test('the homepage is loading', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $this->assertTrue(Route::has('home'));
    $response->assertViewIs('tenant-entry');
});
