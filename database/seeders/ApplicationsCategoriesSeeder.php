<?php

namespace Database\Seeders;

use App\Models\ApplicationCategories;
use App\Models\CategoriesCases;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class ApplicationsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('applications_categories') as $class => $contents) {
            foreach ($contents as $model) {
                ApplicationCategories::updateOrCreate(['id' => $model['id']], $model);
            }
        }
    }
}
