<?php

use App\Task;
use App\TaskCategory;
use Illuminate\Support\Facades\DB;

class TaskManagerService {

    public function createTask($taskName, $categories) {
        DB::beginTransaction();
        try {
            $taskCreated = Task::create(['name'=>$taskName]);
            $this->createTaskCategory($taskCreated, $categories);
            DB::commit();
            return $taskCreated;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception();
        }
    }

    private function createTaskCategory($taskCreated, $categories) {

        foreach($categories as $category) {
            TaskCategory::create(['task_id'=>$taskCreated->id, 'category_id'=>$category]);
        }
    }

}