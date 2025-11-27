<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskServices;
use App\Traits\ResponseTrait;

class TaskController extends Controller{

    function getAllTasks($id = null){
        if(!$id){
            $tasks = Task::all();
            return ResponseTrait::responseJSON($tasks);
        }

        $task = Task::find($id);
        return ResponseTrait::responseJSON($task);
    }

    function addOrUpdateTask(Request $request, $id = "add"){
        if($id == "add"){
            $task = new Task;
        }else{
            $task = Task::find($id);
            if(!$task){
                return ResponseTrait::responseJSON(null, "failure", 400);
            }
        }

        $task->name = $request["name"];
        $task->color = $request["color"];
        $task->description = $request["description"];

        if($task->save()){
            return ResponseTrait::responseJSON($task);
        }

        return ResponseTrait::responseJSON(null, "failure", 400);
    }

}



//Task::first(); <- this is an obj
//Task::last(); <- this is an obj
//Task::where("title", "project")->get(); <- this is an array
//Task::where("title", "project")->first(); <- this is an obj
//Task::where()->orWhere()->get();
//Task::find(5)->delete();
//$task = Task::create([]); XXXXX 
//$task = Task::update([]);
//::where("age", >, 10); 
//::where("age", <>, 10); 
