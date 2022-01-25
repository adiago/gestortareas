<?php

namespace App\Http\Controllers;

use App\Http\Services\TaskManagerService;
use Illuminate\Http\Request;

class TaskManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskManagerService = new TaskManagerService();
        $tasks = $taskManagerService->getAllTasks();

        return view('welcome')->with('tasks', $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taskManagerService = new TaskManagerService();
        $data = $request->get('data');

        return $taskManagerService->createTask($data);     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (new TaskManagerService())->deleteTask($id);
    }
}
