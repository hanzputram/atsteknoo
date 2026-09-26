<?php

test('homepage returns successful response with distributor alat listrik surabaya keywords', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Distributor Alat Listrik Surabaya');
    $response->assertSee('Schneider');
});

test('dedicated pillar page for distributor alat listrik surabaya renders correctly', function () {
    $response = $this->get('/distributor-alat-listrik-surabaya');

    $response->assertStatus(200);
    $response->assertSee('Distributor Alat Listrik Surabaya');
    $response->assertSee('application/ld+json', false);
    $response->assertSee('PT. Anugerah Tama Sejati');
});

test('alternative supplier slugs redirect permanently to canonical pillar page', function () {
    $response = $this->get('/supplier-alat-listrik-surabaya');
    $response->assertRedirect('/distributor-alat-listrik-surabaya', 301);

    $response2 = $this->get('/toko-alat-listrik-surabaya');
    $response2->assertRedirect('/distributor-alat-listrik-surabaya', 301);
});
