<?php

namespace Tests\Unit;

use Database\Factories\MovieFactory;
use PHPUnit\Framework\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class MovieControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    // public function testIndexWithFilters()
    // {
    //     // Create test movies
    //     $movie1 = Movie::factory()->create(['genre' => 'action', 'director' => 'John Doe']);
    //     $movie2 = Movie::factory()->create(['genre' => 'comedy', 'director' => 'Jane Smith']);
    //     $movie3 = Movie::factory()->create(['genre' => 'action', 'director' => 'John Smith']);

    //     // Make GET request to /movies endpoint with filters
    //     $response = $this->get('/api/movies?genre=action&director=John');

    //     // Assert response status is 200 (OK)
    //     $response->assertStatus(200);
    //     // Assert response contains the filtered movies
    //     $response->assertJson([
    //         'data' => [
    //             [
    //                 'id' => $movie1->id,
    //                 'genre' => 'action',
    //                 'director' => 'John Doe',
    //             ],
    //             [
    //                 'id' => $movie3->id,
    //                 'genre' => 'action',
    //                 'director' => 'John Smith',
    //             ],
    //         ],
    //     ]);
    // }

    // public function testIndexWithFilters()
    // {
    //     $genre = 'action';
    //     $director = 'John Doe';

    //     $response = $this->get('/api/movies?genre=' . $genre . '&director=' . $director);

    //     $response->assertStatus(200)
    //         ->assertJsonFragment(['genre' => $genre])
    //         ->assertJsonFragment(['director' => $director]);
    // }

    public function testIndexWithFilters()
{
    $genre = 'action';
    $director = 'John Doe';

    $response = $this->getJson('/api/movies', [
        'genre' => $genre,
        'director' => $director
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['genre' => $genre])
        ->assertJsonFragment(['director' => $director]);
}




    public function testIndexWithPagination()
    {
        // Create test movies
        Movie::factory()->count(15)->create();

        // Make GET request to /movies endpoint with pagination
        $response = $this->get('/api/movies?page=2&per_page=5');

        // Assert response status is 200 (OK)
        $response->assertStatus(200);

        // Assert response contains the correct pagination information
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => ['id', 'title', 'genre', 'director','release_date','status'],
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }
}
