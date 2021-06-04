<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WriteTest extends TestCase
{

    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_posting_to_the_endpoint_works()
    {
        $key = $this->faker->word();
        $value = $this->faker->word();

        $response = $this->post('/api/object', [ 'key' => $key, 'value' => $value ]);
        $response->assertStatus(200);   

        $returnValue = json_decode($response->getContent());
        $this->assertTrue($returnValue->data->_id !== null);
        $this->assertTrue($returnValue->data->key === $key);
        $this->assertTrue($returnValue->data->value === $value);
    }
}
