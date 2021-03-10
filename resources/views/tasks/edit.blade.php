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
            <form method="post" action="{{route('tasks.update', $task)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="exampleFormControlInput1">{{ __('messages.Name') }}</label>
                  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{$task->name}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ __('messages.Description') }}</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{!! $task->description !!}</textarea>
                  </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">{{ __('messages.Status') }}</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="status_id">
                      <option value="">---------</option>
                    @foreach($taskStatuses as $id => $name)
                        <option value="{{$id}}" @if(isset($task->status->id) && $id == $task->status->id) selected @endif>{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">{{ __('messages.Assigned') }}</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="assigned_to_id">
                    <option value="">---------</option>
                    @foreach($users as $id => $name)
                        <option value="{{$id}}" @if(isset($task->assignedTo->id) && $id == $task->assignedTo->id) selected @endif>{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect2">{{ __('messages.Labels') }}</label>
                  <select name="labels[]" multiple class="form-control" id="exampleFormControlSelect2">
                    @foreach($labels as $id => $name)
                        <option value="{{$id}}" @if(in_array($id, $task->labels->pluck('id')->all())) selected @endif>{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.Refresh')}}</button>
              </form>
        </div>
    </div>
</div>
@endsection