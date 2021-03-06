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
            {{-- {{Form::model($task, ['url' => route('tasks.store'), 'method' => 'post', 'class' => 'form-group'])}}
                {{ Form::label('name', 'name', ['class' => 'control-label']) }}
                {{Form::text('name', $value = old('name'), ['class' => 'form-control form-control-lg d-block d-md-block mb-3', 'placeholder' => __('messages.Enter task name')])}}
                {{ Form::label('description', 'description', ['class' => 'control-label']) }}
                {{Form::textarea('description', $value = old('description'), ['class' => 'form-control form-control-lg d-block d-md-block mb-3', 'placeholder' => __('messages.Enter description'), 'rows' => '5'])}}
                {{ Form::label('status_id', 'status', ['class' => 'control-label']) }}
                {{Form::select('size', ['L' => 'Large', 'S' => 'Small'])}}
                {{Form::submit(__('messages.Send'), ['class' => 'btn btn-lg btn-primary ms-md-3 px-5 text-uppercase'])}}
            {{Form::close()}} --}}
            <form method="post" action="{{route('tasks.store')}}">
                @csrf
                <input type="hidden" name="created_by_id" value="{{ auth()->user()->id }}">
                <div class="form-group">
                  <label for="exampleFormControlInput1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Status</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="status_id">
                    @foreach($taskStatuses as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Assigned</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="assigned_to_id">
                    <option value="">------</option>
                    @foreach($users as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect2">Labels</label>
                  <select name="labels[]" multiple class="form-control" id="exampleFormControlSelect2">
                    @foreach($labels as $id => $name)
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