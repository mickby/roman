<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Conversion;

class RomanApiTest extends TestCase {
    use RefreshDatabase;

    public function test_convert_valid_integer() {
        $response = $this->postJson('/api/convert', ['integer' => 10]);

        $response->assertStatus(200)
            ->assertJson(['roman' => 'X']);

        $this->assertDatabaseHas('conversions', [
            'integer_value' => 10,
            'roman_value' => 'X',
        ]);
    }

# count is incremented
# validation too high
# validate string



}
