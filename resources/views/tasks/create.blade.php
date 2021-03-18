@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __('messages.Add new task') }}</h2>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::model($task, ['url' => route('tasks.store'), 'method' => 'post'])}}
                {{Form::hidden('created_by_id', $value = auth()->user()->id)}}
                {{ Form::bsText(__('messages.Name')) }}
                {{ Form::bsTextarea(__('messages.Description')) }}
                {{ Form::bsSelect('status_id', __('messages.Status'),  $taskStatuses, []) }}
                {{ Form::bsSelect('assigned_to_id', __('messages.Assigned'), ['' => '---------'] + $users) }}
                {{ Form::bsSelect('labels[]', __('messages.Labels'), $labels, null, [ 'multiple' => 'multiple']) }}
                {{Form::submit(__('messages.Сreate'), ['class' => 'btn btn-primary'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection