@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __('messages.Edit tag') }}</h2>
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
                {{-- <input type="hidden" name="created_by_id" value="{{ auth()->user()->id }}"> --}}
                <div class="form-group">
                  <label for="exampleFormControlInput1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{$task->name}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{!! $task->description !!}</textarea>
                  </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Status</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="status_id">
                      <option value="{{$task->status->id}}">{{$task->status->name}}</option>
                    @foreach($taskStatuses as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Assigned</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="assigned_to_id">
                    @if($task->assignedTo === null)
                    <option value="">---------</option>
                    @else
                    <option value="{{$task->assignedTo->id}}">{{$task->assignedTo->name}}</option>
                    @endif
                    @foreach($users as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.Send')}}</button>
              </form>
        </div>
    </div>
</div>
@endsection