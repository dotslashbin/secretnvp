<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\NVPModel;
use PhpParser\Node\Expr\Instanceof_;

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

    /**
     * Tests the correctness of pagination data
     *
     * @return void
     */
    public function test_to_see_if_pagination_results_are_correct() {

        $page = 5;
        $limit = 10;

        $response = $this->get(self::API_PATH.'/get-all-records?page='.$page.'.&limit='.$limit);
        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $this->assertEquals($page, $content->page);
        $this->assertEquals($limit, $content->itemsPerPage);
        $this->assertEquals($limit, count($content->data));
    }

    /**
     * Tests to see if fetching one does indeed return the latest out of the collection. 
     * This asssumes that there is a record with key = 'FOO'. This has been set from within the 
     * db seeder. 
     *
     * @return void
     */
    public function test_if_fetching_one_returns_the_latest()
    {
        $testKey = 'FOO';
        $response = $this->get(self::API_PATH.'/'.$testKey);
        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $this->assertTrue(is_object($content->data));
        $basis = NVPModel::where('key', $testKey)->orderByDesc('created_at')->limit(1)->get(); 
        $this->assertEquals($basis[0]->_id, $content->data->_id);
    }

    /**
     * Tests  to see if fetching one with a given timestamp does return the correct record
     *
     * @return void
     */
    public function test_if_fetching_with_timestamp_returns_the_correct_record()
    {
        $testKey        = 'FOO';
        $basis          = NVPModel::where('key', $testKey)->get();
        $testSubject    = $basis[rand(0, count($basis) - 1)];

        $timeStampToMatch = date("U", strtotime($testSubject->created_at));

        $response = $this->get(self::API_PATH.'/'.$testKey.'?timestamp='.$timeStampToMatch);
        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $this->assertEquals($testSubject->_id, $content->data->_id);
        $this->assertEquals($timeStampToMatch, date("U", strtotime($content->data->created_at)));
    }
}