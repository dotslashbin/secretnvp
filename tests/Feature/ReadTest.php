<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadTest extends TestCase
{
    const API_PATH = '/api/object';

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
        $response = $this->get(self::API_PATH.'/'.$inputValue);
        $response->assertStatus(200);
        $content = $response->getContent(); 

        $result = json_decode($content);
        $this->assertTrue($result->data->key === $inputValue);
    }

    /**
     * Test to see if pagination works when there are no parameters given. 
     * @return void
     */
    public function test_to_see_if_calling_to_get_all_without_parameters_returns_a_paginated_result()
    {
        $response = $this->get(self::API_PATH.'/get-all-records');
        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $this->assertTrue(count($content->data) <= config('app.DEFAULT_ITEMS_PER_PAGE'));
    }
}