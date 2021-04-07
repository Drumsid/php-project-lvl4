<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $labels = Label::paginate(20);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $label = new Label();
        return view('labels.create', compact('label'));
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
            'name' => 'required|min:3|unique:labels,name',
            'description' => 'nullable'
        ]);

        $taskStatus = new Label();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('messages.Label added successfully!'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\View\View
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Label $label)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name',
            'description' => 'nullable',
        ]);
        $label->fill($data);
        $label->save();
        flash(__('messages.Label edited successfully!'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('messages.Action is not possible!'))->warning();
            return redirect()->route('labels.index');
        }
        $label->delete();
        flash(__('messages.Label deleted successfully!'))->success();
        return redirect()->route('labels.index');
    }
}
