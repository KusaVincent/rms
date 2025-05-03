<?php

test('the properties page is loading', function () {
    $response = $this->get('/properties');

    $response->assertStatus(200);
});
