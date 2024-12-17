<?php


use App\Models\Conversion;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RomanApiTest extends TestCase {
    use RefreshDatabase;

    public function test_convert_valid_integer_is_stored() {
        $response = $this->postJson(route('convert'), ['integer' => 10]);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('conversions', [
            'integer_value' => 10,
            'roman_value' => 'X',
        ]);
    }

    #could add tests to test the validation (by passing a string or an int
    # which is out of range) but I don't see the point because that is just
    # testing Laravel.


    public function test_result_is_returned() {
        $response = $this->postJson(route('convert'), ['integer' => 10]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJsonStructure([
            'data' => [
                    'integer_value',
                    'roman_value'
            ],
        ]);
    }

    public function test_can_get_recent_conversions()
    {
        $conversion = Conversion::factory()->count(10)
            ->create(['created_at' => now()]);

        #some from yesterday
        $conversion = Conversion::factory()->count(10)
            ->create(['created_at' => now()->subDay()]);


        $response = $this->getJson(route('recent'));

        #check that the response contains 10 models that were created today
        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(10, $response->json('data'));
        foreach ($response->json('data') as $conversion) {
            $this->assertEquals(Carbon::today()->toDateString(), Carbon::parse($conversion['created_at'])->toDateString());
        }

    }

    public function test_can_get_top_conversions()
    {
        #seed the top 10
        $top = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
        for ($i = 0; $i < 10; $i++) {
            $conversion = Conversion::factory()
                ->count(100)
                ->create([
                    'roman_value' => $top[$i],
                    'integer_value' => $i+1
                ]);
        }

        #now a few random ones
        $conversion = Conversion::factory()->count(500)->create();

        $response = $this->getJson(route('top'));

        #check that the response contains the top 10 models
        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(10, $response->json('data'));
        $topInts = array_column($response->json('data'),'integer_value');
        sort($topInts);
        self::assertEquals($topInts, [1,2,3,4,5,6,7,8,9,10]);

    }


}
