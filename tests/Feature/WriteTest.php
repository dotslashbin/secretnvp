<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WriteTest extends TestCase
{

    use WithFaker;

    /**
     * Test to see if the endpoint works providing the correct inputs
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

    /**
     * Tests to see if the inputs are sanitized upon saving
     *
     * @return void
     */
    public function test_if_inputs_are_sanitized() 
    {
        $key = '<haha>destroyWebsite</haha>';
        $value = '<script>textwithtag</script>';

        $response = $this->post('/api/object', [ 'key' => $key, 'value' => $value ]);
        $response->assertStatus(200);   

        $returnValue = json_decode($response->getContent());
        $this->assertTrue($returnValue->data->key === 'destroyWebsite');
        $this->assertTrue($returnValue->data->value === 'textwithtag');
    }

    public function test_if_invalid_characters_are_captured()
    {
        $key = '<haha>thismu*&#*$&^$*#stfai821739872937</haha>';
        $value = '<script>textwithtag(*#&49</script>';

        $response = $this->post('/api/object', [ 'key' => $key, 'value' => $value ]);
        $response->assertStatus(422);   
        $result = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($result->key));
        $this->assertGreaterThan(0, count($result->value));
    }
}
