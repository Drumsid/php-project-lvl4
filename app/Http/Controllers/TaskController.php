<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        return view('tasks.create', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'status_id' => 'required',
            'created_by_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
        ]);
        $task = new Task();
        $task->fill($data);
        $task->save();
        flash(__('messages.Task added successfully!'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $taskStatuses = TaskStatus::where('id', '!=', $task->status->id)->pluck('name', 'id')->all();
        if ($task->assigned_to) {
            $users = User::where('id', '!=', $task->assigned_to->id)->pluck('name', 'id')->all();
        }
        $users = User::pluck('name', 'id')->all();
        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'status_id' => 'required',
            // 'created_by_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable',
        ]);
        $task->fill($data);
        $task->save();
        flash(__('messages.Task edited successfully!'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user()->id;
        if ($task && $user == $task->created_by_id) {
            $task->delete();
            flash(__('messages.Task deleted successfully!'))->success();
        } else {
            flash(__('HZ'))->success();
        }
        return redirect()->route('tasks.index');
    }
}
