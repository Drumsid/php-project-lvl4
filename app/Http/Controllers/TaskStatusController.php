<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(20);
        return view('taskStatus.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('taskStatus.create', compact('taskStatus'));
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
            'name' => 'required|min:3|unique:task_statuses,name',
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('messages.Status added successfully!'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        return view('taskStatus.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name'
        ]);
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('messages.Status edited successfully!'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $taskStatus = TaskStatus::find($id);
        if (is_null($taskStatus)) {
            throw new \Exception("Status does not exist");
        }
        if ($taskStatus->task()->exists()) {
            flash(__('messages.Action is not possible!'))->success();
            return redirect()->route('task_statuses.index');
        }
        if ($taskStatus) {
            $taskStatus->delete();
            flash(__('messages.Status deleted successfully!'))->success();
        }
        return redirect()->route('task_statuses.index');
    }
}
