<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WriteTest extends TestCase
{

    use WithFaker;

    const API_PATH = '/api/object';

    /**
     * Test to see if the endpoint works providing the correct inputs
     *
     * @return void
     */
    public function test_if_posting_to_the_endpoint_works()
    {
        $key = $this->faker->word();
        $value = $this->faker->word();

        $response = $this->post(self::API_PATH, [ 'key' => $key, 'value' => $value ]);
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
    public function test_if_tags_are_stripped() 
    {
        $key = '<haha>destroyWebsite</haha>';
        $value = '<script>textwithtag</script>';

        $response = $this->post(self::API_PATH, [ 'key' => $key, 'value' => $value ]);
        $response->assertStatus(200);   

        $returnValue = json_decode($response->getContent());
        $this->assertTrue($returnValue->data->key === 'destroyWebsite');
        $this->assertTrue($returnValue->data->value === 'textwithtag');
    }

    /**
     * Tests to see if invalid characters fails validation
     *
     * @return void
     */
    public function test_if_invalid_characters_are_invalidated()
    {
        $key = '<haha>thismu*&#*$&^$*#stfai821739872937</haha>';
        $value = '<script>textwithtag(*#&49</script>';

        $response = $this->post(self::API_PATH, [ 'key' => $key, 'value' => $value ]);
        $response->assertStatus(422);   
        $result = json_decode($response->getContent());
        $this->assertGreaterThan(0, count($result->key));
        $this->assertGreaterThan(0, count($result->value));
        $this->assertEquals("The key must only contain letters and numbers.", $result->key[0]);
        $this->assertEquals("The value must only contain letters and numbers.", $result->value[0]);
    }

    /**
     * Tests to see if no input fails validation
     *
     * @return void
     */
    public function test_if_no_input_fails_validation()
    {
        $response = $this->post(self::API_PATH, [ 'key' => null, 'value' => null ]);
        $response->assertStatus(422);   

        $response = $this->post(self::API_PATH);
        $response->assertStatus(422);   
    }

    /**
     * Tests to see if the app breaks when there are other inputs besides the 
     * expected "key" and "value".
     *
     * @return void
     */
    public function test_to_see_if_unexpected_inputs_will_not_cause_a_crash_or_be_saved()
    {
        $key = $this->faker->word();
        $value = $this->faker->word();

        $response = $this->post(self::API_PATH, [ 'key' => $key, 'value' => $value, 'unwated' => 'input', 'another' => 'unexpected input' ]);
        $response->assertStatus(200);   
        $result = json_decode($response->getContent());
        $insertedRecord = $result->data;
        $this->assertEquals($key, $insertedRecord->key);
        $this->assertEquals($value, $insertedRecord->value);
        $this->assertFalse(property_exists($insertedRecord, 'unwanted'));
    }
}
