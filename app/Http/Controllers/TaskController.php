<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $tasks = QueryBuilder::for(Task::class)
                ->allowedFilters([
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id'),
                ])
                ->get();
        return view('tasks.index', compact('tasks', 'taskStatuses', 'users'));
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
        $labels = Label::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        return view('tasks.create', compact('task', 'taskStatuses', 'users', 'labels'));
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
        $request->validate([
            'name' => 'required|min:3',
            'status_id' => 'required',
            'created_by_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
        ]);

        $data = $request->all();

        $task = Task::create($data);
        $task->labels()->sync($request->labels);
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
        $taskStatuses = TaskStatus::pluck('name', 'id')->all();
        $taskStatusesSelected = [];
        if (isset($task->status->id)) {
            $taskStatusesSelected[] = $task->status->id;
        }
        $userSelected = [];
        if (isset($task->assignedTo->id)) {
            $userSelected[] = $task->assignedTo->id;
        }
        $labels = Label::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $labelsSelected = $this->findSelectedLabels($labels, $task);
        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels', 'taskStatusesSelected', 'userSelected', 'labelsSelected'));
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
        $request->validate([
            'name' => 'required|min:3',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable',
        ]);

        $task = Task::findOrFail($id);
        $data = $request->all();

        $task->update($data);
        $task->labels()->sync($request->labels);
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

    public function findSelectedLabels($labels, $task)
    {
        $collection = collect($labels);

        $filtered = $collection->filter(function ($name, $id) use ($task) {
            if (in_array($id, $task->labels->pluck('id')->all())) {
                return $id;
            }
        });
        return $filtered->keys()->all();
    }
}
