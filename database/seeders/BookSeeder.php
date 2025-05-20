<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            ['title' => 'Ronggeng Dukuh Paruk', 'author_id' => 1, 'year' => 1982, 'status' => 'tersedia'],
            ['title' => 'Perahu Kertas', 'author_id' => 2, 'year' => 2009, 'status' => 'dipinjam'],
        ]);
    }
}
