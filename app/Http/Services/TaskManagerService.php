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

        DB::beginTransaction();
        try {
            $taskCreated = Task::create(['title'=>$taskName]);
            $this->createTaskCategory($taskCreated, $data);
            DB::commit();

            return Task::with('categories')->find($taskCreated->id);
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception();
        }
    }

    public function deleteTask($id) {
        $this->deleteTaskCategory($id);
        Task::find($id)->delete();
        
    }
    public function getAllTasks() {
        return Task::with('categories')->get();
    }

    private function deleteTaskCategory($taskId) {
        TaskCategory::where('task_id', $taskId)->delete();
    }

    private function createTaskCategory($taskCreated, $data) {
        if($data['php']=='true') $categories[] = Category::PHP;
        if($data['js']=='true') $categories[] = Category::JS;
        if($data['css']=='true') $categories[] = Category::CSS;

        foreach($categories as $category) {
            TaskCategory::create(['task_id'=>$taskCreated->id, 'category_id'=>$category]);
        }
    }

}