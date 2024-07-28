<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            UPDATE testimonials
            SET name = JSON_OBJECT('en', name, 'bn', name);
        ");
        DB::statement("
            UPDATE testimonials
            SET designation = JSON_OBJECT('en', designation, 'bn', designation);
        ");
        DB::statement("
            UPDATE testimonials
            SET comments = JSON_OBJECT('en', comments, 'bn', comments);
        ");
    }
}
