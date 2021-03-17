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
                <div class="form-group">
                  {{ Form::label(__('messages.Name'), null, ['class' => 'control-label']) }}
                  {{Form::text('name', $value = old('name'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Description'), null, ['class' => 'control-label']) }}
                  {{Form::textarea('description', $value = old('name'), ['class' => 'form-control'])}}
                </div>
                {{-- {{ Form::bsText(__('messages.Name')) }}
                {{ Form::bsTextarea(__('messages.Description')) }}
                {{ Form::bsSelect(__('messages.Status'), $taskStatuses) }}
                {{ Form::bsSelect(__('messages.Assigned'), ['' => '---------'] + $users) }} --}}
                {{-- {{ Form::bsSelect(__('messages.Labels'), $labels, ['multiple']) }} --}}

                <div class="form-group">
                  {{ Form::label(__('messages.Status'), null, ['class' => 'control-label']) }}
                  {{Form::select('status_id', $taskStatuses, null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Assigned'), null, ['class' => 'control-label']) }}
                  {{Form::select('assigned_to_id', ['' => '---------'] + $users, null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Labels'), null, ['class' => 'control-label']) }}
                  {{Form::select('labels[]', $labels, null, ['class' => 'form-control', 'multiple'])}}
                </div>
                {{Form::submit(__('messages.Сreate'), ['class' => 'btn btn-primary'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection