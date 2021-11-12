<?php

namespace Database\Seeders;

use App\Models\CategoriesCases;
use Illuminate\Database\Seeder;

class CategoriesCasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('categories_cases') as $class => $contents) {
            foreach ($contents as $model) {
                CategoriesCases::updateOrCreate(['id' => $model['id']], $model);
            }
        }
    }
}
