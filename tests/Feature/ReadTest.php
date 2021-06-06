<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadTest extends TestCase
{
    public function test_if_active_route() {
        $response = $this->get('/api/object/test');
        $response->assertStatus(200);
    }
}