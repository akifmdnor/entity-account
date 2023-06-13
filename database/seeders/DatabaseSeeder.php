<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('entities')->insert(['name' => Str::random(10), 'tax_number' => random_int(1000, 9999), 'legal_address' => Str::random(20), 'created_at' => Carbon::now()->toDateTimeString()]);
    }
}
