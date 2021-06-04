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

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_the_resulting_key_are_the_same()
    {
        $inputValue = 'FOO';
        $content = $this->get('/api/object/'.$inputValue)->getContent();

        $result = json_decode($content);
        $this->assertTrue($result->data->key === $inputValue);
    }
}