<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;
use App\Functions\Helper;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 10; $i++){
            $new_project = new Project();
            // Associo randomicamente una tecnologia al progetto
            $new_project->technology_id = Technology::inRandomOrder()->first()->id;
            $new_project->name = $faker->sentence();
            $new_project->slug = Helper::generateSlug($new_project->name, Project::class);
            $new_project->description = $faker->paragraph();
            $new_project->date = $faker->date();
            $new_project->save();
        }
    }
}
