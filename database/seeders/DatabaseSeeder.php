<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'The Reset Menu', 'slug' => 'the-reset-menu', 'category' => 'Meal plans', 'short_description' => 'A bright, 7-day reset with simple prep and feel-good favorites.', 'description' => 'A practical seven-day menu designed to make nourishing choices feel easy.', 'price' => 18, 'compare_price' => 24, 'pages' => 32, 'featured' => true],
            ['name' => 'Sunday Prep Recipes', 'slug' => 'sunday-prep-recipes', 'category' => 'Recipes', 'short_description' => '25 recipes that turn one calm hour into a week of good food.', 'description' => 'Batch-friendly recipes for colorful breakfasts, lunches, and dinners.', 'price' => 14, 'pages' => 28, 'featured' => true],
            ['name' => 'Good Morning Guide', 'slug' => 'good-morning-guide', 'category' => 'Guides', 'short_description' => 'A gentle morning rhythm for more energy and less rushing.', 'description' => 'A compact guide to building a restorative, repeatable morning routine.', 'price' => 9, 'pages' => 18, 'featured' => false],
            ['name' => 'The Cozy Dinner Club', 'slug' => 'cozy-dinner-club', 'category' => 'Recipes', 'short_description' => '18 unfussy dinners for nights when comfort and color matter.', 'description' => 'A seasonal collection of nourishing dinners for sharing or saving.', 'price' => 16, 'pages' => 24, 'featured' => true],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
