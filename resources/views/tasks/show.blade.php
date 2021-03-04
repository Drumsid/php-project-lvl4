@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-5">{{ __('messages.View a task') . ": " . $task->name}}</h2>
            <p>{{ __('messages.Name') . ": " . $task->name}}</p>
            <p>{{ __('messages.Status') . ": " . $task->status->name}}</p>
            <p>{{ __('messages.Description') . ": " . $task->description ?? null}}</p>
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                {{ __('messages.edit') }}
            </a>
        </div>

    </div>
</div>
@endsection
