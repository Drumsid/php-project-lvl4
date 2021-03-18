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
                {{ Form::bsText(__('messages.Name')) }}
                {{ Form::bsTextarea(__('messages.Description')) }}
                {{ Form::bsSelect('status_id', __('messages.Status'),  $taskStatuses, $taskStatusesSelected) }}
                {{ Form::bsSelect('assigned_to_id', __('messages.Assigned'), ['' => '---------'] + $users, $userSelected) }}
                {{ Form::bsSelect('labels[]', __('messages.Labels'), $labels, $labelsSelected, [ 'multiple' => 'multiple']) }}
                {{Form::submit(__('messages.Refresh'), ['class' => 'btn btn-primary'])}}
            {{Form::close()}}
            </div>
    </div>
</div>
@endsection