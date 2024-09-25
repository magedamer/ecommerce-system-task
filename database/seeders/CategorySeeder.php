<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->name = $this->generateRandomCategoryName();
            $category->parent_id = $this->generateRandomParentId();
            $category->status = $this->generateRandomStatus();
            $category->save();
        }
    }

    private function generateRandomCategoryName()
    {
        $adjectives = ['Fashion', 'Electronics', 'Home', 'Garden', 'Sports'];
        $nouns = ['Shoes', 'TVs', 'Furniture', 'Plants', 'Balls'];
        return $adjectives[rand(0, count($adjectives) - 1)] . ' ' . $nouns[rand(0, count($nouns) - 1)];
    }

    private function generateRandomParentId()
    {
        return rand(0, 5); // 0 means no parent category
    }

    private function generateRandomStatus()
    {
        return rand(0, 1) ? 'active' : 'inactive';
    }
}
