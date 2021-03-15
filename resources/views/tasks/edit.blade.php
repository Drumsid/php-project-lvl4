@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __('messages.Edit Task') }}</h2>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PUT'])}}
                <div class="form-group">
                  {{ Form::label(__('messages.Name'), null, ['class' => 'control-label']) }}
                  {{Form::text('name', $value = old('name'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Description'), null, ['class' => 'control-label']) }}
                  {{Form::textarea('description', $value = old('name'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Status'), null, ['class' => 'control-label']) }}
                  {{Form::select('status_id', $taskStatuses, $taskStatusesSelected, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Assigned'), null, ['class' => 'control-label']) }}
                  {{Form::select('assigned_to_id', ['' => '---------'] + $users, $userSelected, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Labels'), null, ['class' => 'control-label']) }}
                  {{Form::select('labels[]', $labels, $labelsSelected, ['class' => 'form-control', 'multiple'])}}
                </div>
                {{Form::submit(__('messages.Refresh'), ['class' => 'btn btn-primary'])}}
            {{Form::close()}}
            </div>
    </div>
</div>
@endsection