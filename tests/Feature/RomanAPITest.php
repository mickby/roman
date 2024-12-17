<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RomanApiTest extends TestCase {
    use RefreshDatabase;

    public function test_convert_valid_integer_is_stored() {
        $response = $this->postJson('/api/convert', ['integer' => 10]);

        $response->assertStatus(200); ## todo use constants

        $this->assertDatabaseHas('conversions', [
            'integer_value' => 10,
            'roman_value' => 'X',
        ]);
    }

    #could add tests to test the validation (by passing a string or an int
    # which is out of range) but I don't see the point because that is just
    # testing Laravel.


    public function test_result_is_returned() {
        $response = $this->postJson('/api/convert', ['integer' => 10]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                    'integer_value',
                    'roman_value',
                    'updated_at',
                    'created_at',
                    'id',
            ],
        ]);
    }



    # Resource response
# count is incremented
# validation too high
# validate string



}
