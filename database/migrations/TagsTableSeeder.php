<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            // Purple tags
            ['id' => 1, 'nama' => 'Agriculture', 'parent_id' => null],
            ['id' => 2, 'nama' => 'Air', 'parent_id' => null],
            ['id' => 3, 'nama' => 'Biodiversity and Ecosystems', 'parent_id' => null],
            ['id' => 4, 'nama' => 'Climate', 'parent_id' => null],
            ['id' => 5, 'nama' => 'Diversity and Inclusion', 'parent_id' => null],
            ['id' => 6, 'nama' => 'Education', 'parent_id' => null],
            ['id' => 7, 'nama' => 'Employment', 'parent_id' => null],
            ['id' => 8, 'nama' => 'Energy', 'parent_id' => null],
            ['id' => 9, 'nama' => 'Financial Services', 'parent_id' => null],
            ['id' => 10, 'nama' => 'Health', 'parent_id' => null],
            ['id' => 11, 'nama' => 'Infrastructure', 'parent_id' => null],
            ['id' => 12, 'nama' => 'Land', 'parent_id' => null],
            ['id' => 13, 'nama' => 'Oceans and Coastal Zones', 'parent_id' => null],
            ['id' => 14, 'nama' => 'Pollution', 'parent_id' => null],
            ['id' => 15, 'nama' => 'Real Estate', 'parent_id' => null],
            ['id' => 16, 'nama' => 'Waste', 'parent_id' => null],
            ['id' => 17, 'nama' => 'Water', 'parent_id' => null],

            // Gray tags with parent_id
            ['id' => 18, 'nama' => 'Smallholder Agriculture', 'parent_id' => 1],
            ['id' => 19, 'nama' => 'Sustainable Agriculture', 'parent_id' => 1],
            ['id' => 20, 'nama' => 'Food Security', 'parent_id' => 1],
            ['id' => 21, 'nama' => 'Clean Air', 'parent_id' => 2],
            ['id' => 22, 'nama' => 'Biodiversity and Ecosystem Conservation', 'parent_id' => 3],
            ['id' => 23, 'nama' => 'Climate Change Mitigation', 'parent_id' => 4],
            ['id' => 24, 'nama' => 'Climate Resilience and Adaptation', 'parent_id' => 4],
            ['id' => 25, 'nama' => 'Gender Lens', 'parent_id' => 5],
            ['id' => 26, 'nama' => 'Racial Equity', 'parent_id' => 5],
            ['id' => 27, 'nama' => 'Access to Quality Education', 'parent_id' => 6],
            ['id' => 28, 'nama' => 'Quality Jobs', 'parent_id' => 7],
            ['id' => 29, 'nama' => 'Energy Access', 'parent_id' => 8],
            ['id' => 30, 'nama' => 'Clean Energy', 'parent_id' => 8],
            ['id' => 31, 'nama' => 'Energy Efficiency', 'parent_id' => 8],
            ['id' => 32, 'nama' => 'Financial Inclusion', 'parent_id' => 9],
            ['id' => 33, 'nama' => 'Access to Quality Healthcare', 'parent_id' => 10],
            ['id' => 34, 'nama' => 'Nutrition', 'parent_id' => 10],
            ['id' => 35, 'nama' => 'Resilient Infrastructure', 'parent_id' => 11],
            ['id' => 36, 'nama' => 'Natural Resources Conservation', 'parent_id' => 12],
            ['id' => 37, 'nama' => 'Sustainable Land Management', 'parent_id' => 12],
            ['id' => 38, 'nama' => 'Sustainable Forestry', 'parent_id' => 12],
            ['id' => 39, 'nama' => 'Marine Resources Conservation & Management', 'parent_id' => 13],
            ['id' => 40, 'nama' => 'Pollution Prevention', 'parent_id' => 14],
            ['id' => 41, 'nama' => 'Affordable Quality Housing', 'parent_id' => 15],
            ['id' => 42, 'nama' => 'Green Buildings', 'parent_id' => 15],
            ['id' => 43, 'nama' => 'Waste Management', 'parent_id' => 16],
            ['id' => 44, 'nama' => 'Water, Sanitation and Hygiene (WASH)', 'parent_id' => 17],
            ['id' => 45, 'nama' => 'Sustainable Water Management', 'parent_id' => 17],
        ];

        DB::table('tags')->insert($tags);
    }
}
