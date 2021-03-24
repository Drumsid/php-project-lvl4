<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use Illuminate\Support\Facades\DB;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::paginate(20);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $label = Label::findOrFail($id);
        return view('labels.edit', compact('label'));
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
        $label = Label::findOrFail($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $label = Label::find($id);
        if ($label->tasks()->exists()) {
            flash(__('messages.Action is not possible!'))->success();
            return redirect()->route('labels.index');
        }
        if ($label) {
            $label->delete();
            flash(__('messages.Label deleted successfully!'))->success();
        }
        return redirect()->route('labels.index');
    }
}
