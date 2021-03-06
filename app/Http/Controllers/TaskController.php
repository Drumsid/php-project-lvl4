<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
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
        $filter = $request->get('filter');
        return view('tasks.index', compact('tasks', 'taskStatuses', 'users', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
        ]);
        $user = Auth::user();

        if (!isset($user)) {
                throw new \Exception('User is not authenticated');
        }

        $task = $user->tasks()->make($data);
        $task->save();
        $task->labels()->sync($request->labels);

        flash(__('messages.Task added successfully!'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|min:3',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable',
        ]);

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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();
        flash(__('messages.Task deleted successfully!'))->success();
        return redirect()->route('tasks.index');
    }

    public function findSelectedLabels(array $labels, object $task): array
    {
        $collection = collect($labels);

        $filtered = $collection->filter(function ($name, $id) use ($task) {
            if (in_array($id, $task->labels->pluck('id')->all(), true)) {
                return $id;
            }
        });
        return $filtered->keys()->all();
    }
}
