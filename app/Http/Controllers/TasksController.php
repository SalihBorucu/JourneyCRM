<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;


class TasksController extends Controller
{

	public function create(Task $task)
	{





	}
	public function store()
    {
    		$task = new Task();

    		$task->notes = request('notes');
    		// $task->completed = request()->has('completed');
    		$task->description = request('description');
    		$task->lead_id = request('lead_id');
    		// dd(request('options'));
    		$task->outcome = request('outcome');
    		$task->save();


    		// dd($task);


    		return back();
    }




	public function update(Task $task)

	{
		if(!empty(request('notes')))

			{

				$task->notes = request('notes');

			}
		else
			{

				$task->notes ='';

			};

		// $task->update([
		// 	'completed'=> request()->has('completed')




		// ]);
			return back();
	}

}
