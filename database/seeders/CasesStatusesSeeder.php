<?php

namespace Database\Seeders;

use App\Models\CasesStatus;
use Illuminate\Database\Seeder;

class CasesStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('cases_statuses') as $class => $contents) {
            foreach ($contents as $model) {
                CasesStatus::updateOrCreate(['id' => $model['id']], $model);
            }
        }
    }
}