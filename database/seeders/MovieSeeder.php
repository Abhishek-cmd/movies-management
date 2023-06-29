<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title' => 'Movie 1',
                'genre' => 'This is movie 1.',
                'release_date' => '2021-01-01',
                'director' => 'Director 1',
                'status' => 'active'
            ],
            [
                'title' => 'Movie 2',
                'genre' => 'This is movie 2.',
                'release_date' => '2022-01-01',
                'director' => 'Director 2',
                'status' => 'active'
            ],
            [
                'title' => 'Movie 3',
                'genre' => 'This is movie 3.',
                'release_date' => '2022-01-01',
                'director' => 'Director 3',
                'status' => 'active'
            ],
            [
                'title' => 'Movie 4',
                'genre' => 'This is movie 4.',
                'release_date' => '2022-01-01',
                'director' => 'Director 4',
                'status' => 'active'
            ],
            [
                'title' => 'Movie 5',
                'genre' => 'This is movie 5.',
                'release_date' => '2022-01-01',
                'director' => 'Director 5',
                'status' => 'active'
            ],
            // Add more records as needed
        ]);
    }
}
