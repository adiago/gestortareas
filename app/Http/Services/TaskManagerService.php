<?php

namespace App\Http\Services;

use App\Category;
use App\Task;
use App\TaskCategory;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskManagerService {

    public function createTask($data) {
        $taskName = trim($data['taskname']);
        $categories = [];
        if($data['php']) $categories[] = Category::PHP;
        if($data['js']) $categories[] = Category::JS;
        if($data['css']) $categories[] = Category::CSS;

        DB::beginTransaction();
        try {
            $taskCreated = Task::create(['title'=>$taskName]);
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