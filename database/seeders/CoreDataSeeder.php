<?php
namespace Database\Seeders;

use App\Models\ApplicationCategories;
use Illuminate\Database\Seeder;

class CoreDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('core_data') as $class => $contents) {
            foreach ($contents as $model)
                ApplicationCategories::updateOrCreate(['id' => $model['id']], $model);
        }
    }
}
