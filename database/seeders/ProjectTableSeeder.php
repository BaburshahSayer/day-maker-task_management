<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = array(
            array('id' => '1','project_name' => 'IT project','created_by' => '1','updated_by' => NULL,'deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-06 04:41:16','updated_at' => '2021-12-06 04:41:16'),
            array('id' => '2','project_name' => 'Logistic','created_by' => '1','updated_by' => NULL,'deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-06 04:42:23','updated_at' => '2021-12-06 04:42:23'),
            array('id' => '3','project_name' => 'NFI','created_by' => '1','updated_by' => NULL,'deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-06 04:42:37','updated_at' => '2021-12-06 04:42:37')
          );
          foreach ($projects as $project){

              Project::create($project);
          }
        

          
    }
}
