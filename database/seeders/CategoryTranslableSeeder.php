<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            UPDATE categories
            SET name = JSON_OBJECT('en', categoryName, 'bn', categoryName_bn);
        ");
        DB::statement("
            UPDATE categories
            SET details = JSON_OBJECT('en', categoryDetails, 'bn', categoryDetails_bn);
        ");
    }
}
