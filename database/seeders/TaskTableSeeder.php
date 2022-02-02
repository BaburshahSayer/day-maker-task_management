<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = array(
            array('id' => '1','task_title' => 'First Task','priority' => '0','status' => '0','order' => '3','project_id' => '1','created_by' => '1','updated_by' => '1','deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-11 11:29:27','updated_at' => '2021-12-11 11:33:36'),
            array('id' => '2','task_title' => 'Delivery of New Machines','priority' => '1','status' => '1','order' => '1','project_id' => '1','created_by' => '1','updated_by' => '1','deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-11 11:30:56','updated_at' => '2021-12-11 11:33:32'),
            array('id' => '3','task_title' => 'Install New Machines','priority' => '2','status' => '2','order' => '1','project_id' => '3','created_by' => '1','updated_by' => '1','deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-11 11:31:12','updated_at' => '2021-12-11 11:31:57'),
            array('id' => '4','task_title' => 'Remove Existing Machine','priority' => '0','status' => '0','order' => '1','project_id' => '2','created_by' => '1','updated_by' => '1','deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-11 11:31:24','updated_at' => '2021-12-11 11:33:33'),
            array('id' => '5','task_title' => 'Dispose Existing Machine','priority' => '2','status' => '0','order' => '2','project_id' => '1','created_by' => '1','updated_by' => '1','deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-11 11:31:37','updated_at' => '2021-12-11 11:32:04'),
            array('id' => '6','task_title' => 'Task are draggable into different status','priority' => '2','status' => '2','order' => NULL,'project_id' => '1','created_by' => '1','updated_by' => '1','deleted_by' => NULL,'deleted_at' => NULL,'created_at' => '2021-12-11 11:33:24','updated_at' => '2021-12-11 11:33:30')
          );


          foreach ($tasks as $task){

            Task::create($task);
        }
    }
}
