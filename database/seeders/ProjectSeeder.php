<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types_size = Type::all()->count();

        for($i = 0; $i < 5; ++$i){

            $newProject = new Project();

            $newProject->title = $faker->sentence(3);
            $newProject->description = $faker->text(100);
            if($types_size){
                $newProject->type_id = $faker->numberBetween(1, $types_size);
            }
            $newProject->slug = Str::slug($newProject->title, '-');
        
            $newProject->save();
            
        }
    }
}
