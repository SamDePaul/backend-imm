<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->insert([
            ['slug' => 'Agriculture', 'name' => 'Agriculture'],
            ['slug' => 'Air', 'name' => 'Air'],
            ['slug' => 'Biodiversity', 'name' => 'Biodiversity and Ecosystems'],
            ['slug' => 'Ecosystems', 'name' => 'Biodiversity and Ecosystems'],
            ['slug' => 'Climate', 'name' => 'Climate'],
            ['slug' => 'Diversity', 'name' => 'Diversity and Inclusion'],
            ['slug' => 'Inclusion', 'name' => 'Diversity and Inclusion'],
            ['slug' => 'Education', 'name' => 'Education'],
            ['slug' => 'Employment', 'name' => 'Employment'],
            ['slug' => 'Energy', 'name' => 'Energy'],
            ['slug' => 'FinancialServices', 'name' => 'Financial Services'],
            ['slug' => 'Health', 'name' => 'Health'],
            ['slug' => 'Infrastructure', 'name' => 'Infrastructure'],
            ['slug' => 'Land', 'name' => 'Land'],
            ['slug' => 'Oceans', 'name' => 'Oceans & Coastal Zones'],
            ['slug' => 'CoastalZones', 'name' => 'Oceans & Coastal Zones'],
            ['slug' => 'Pollution', 'name' => 'Pollution'],
            ['slug' => 'RealEstate', 'name' => 'Real Estate'],
            ['slug' => 'Waste', 'name' => 'Waste'],
            ['slug' => 'Water', 'name' => 'Water'],
        ]);
    }
}

