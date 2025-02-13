<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'color' => 'red',
        ]);

        Category::create([
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
            'color' => 'blue',
        ]);

        Category::create([
            'name' => 'Machine Learning',
            'slug' => 'machine-learning',
            'color' => 'green',
        ]);

        Category::create([
            'name' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
            'color' => 'yellow',
        ]);
    }
}
