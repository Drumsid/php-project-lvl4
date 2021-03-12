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
            {{-- <form method="post" action="{{route('tasks.store')}}">
                @csrf
                <input type="hidden" name="created_by_id" value="{{ auth()->user()->id }}">
                <div class="form-group">
                  <label for="exampleFormControlInput1">{{ __('messages.Name') }}</label>
                  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ __('messages.Description') }}</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">{{ __('messages.Status') }}</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="status_id">
                    @foreach($taskStatuses as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">{{ __('messages.Assigned') }}</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="assigned_to_id">
                    <option value="">------</option>
                    @foreach($users as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect2">{{ __('messages.Labels') }}</label>
                  <select name="labels[]" multiple class="form-control" id="exampleFormControlSelect2">
                    @foreach($labels as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.Сreate')}}</button>
              </form> --}}
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