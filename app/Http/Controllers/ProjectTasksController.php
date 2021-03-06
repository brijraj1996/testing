<?php

namespace App\Http\Controllers;
use App\Project;
use App\Task;

use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        
        if(auth()->user()->isNot($project->owner))
        {
            abort(403);
        }
        
        request()->validate(['body' => 'required']);

        $project->addTask(request('body')); // we are passing body to the post request in the ProjectTasksTest

        return redirect($project->path());

    }

    public function update(Project $project, Task $task)
    {
        if(auth()->user()->isNot($project->owner))
        {
            abort(403);
        }
    
        $task->update([
           'body'=> request('body'),
           'completed'=> request()->has('completed')  
        ]);

        return redirect($project->path());
    }
}
