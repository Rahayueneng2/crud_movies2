<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Action']);
        Genre::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Comedy']);
        Genre::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Drama']);
        Genre::create(['id' => (string) \Illuminate\Support\Str::uuid(), 'name' => 'Horror']);
    }
}
