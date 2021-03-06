@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-5">{{ __('messages.Tasks') }}</h2>
            <div class="d-flex  mb-5 justify-content-between">
              <form method="GET" action="" class="form-inline">
                <select class="form-control mr-2" name="filter[status_id]">
                  <option selected="selected" value="">Статус</option>
                  @foreach($taskStatuses as $id => $name)
                  <option value="{{$id}}">{{$name}}</option>
                  @endforeach
                </select>
                <select class="form-control mr-2" name="filter[created_by_id]">
                    <option selected="selected" value="">Автор</option>
                    @foreach($users as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
                <select class="form-control mr-2" name="filter[assigned_to_id]">
                  <option selected="selected" value="">Исполнитель</option>
                  @foreach($users as $id => $name)
                  <option value="{{$id}}">{{$name}}</option>
                  @endforeach
                </select>
                  <input class="btn btn-outline-primary mr-2" type="submit" value="Применить">
              </form>
              <div>
                @auth
                <a class="btn btn-primary" href="{{ route('tasks.create') }}" role="button">{{ __('messages.Add task') }}</a>
              @endauth
              </div>
          </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.Description') }}</th>
                        <th scope="col">{{ __('messages.Status') }}</th>
                        <th scope="col">{{ __('messages.User') }}</th>
                        <th scope="col">{{ __('messages.Assigned') }}</th>
                        <th scope="col">{{ __('messages.Date of creation') }}</th>
                        @auth
                          <th scope="col">{{ __('messages.Actions') }}</th>
                        @endauth
                      </tr>
                    </thead>
                    @if (count($tasks))
                    <tbody>
                        @foreach($tasks as $task)    
                      <tr>
                        <th>{{ $task->id }}</th>
                        <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status->name }}</td>
                        <td>{{ $task->createdBy->name }}</td>
                        <td>{{ $asigned = $task->assignedTo->name ?? null }}</td>
                        <td>{{ $task->updated_at }}</td>
                        @auth
                        <td>
                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                {{ __('messages.edit') }}
                            </a>
                        @if(auth()->user()->id == $task->created_by_id)
                            <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post" class="float-left">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Подтвердите удаление')">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        @endif
                        </td>
                        @endauth
                      </tr>
                      @endforeach
                    @else
                    <th>{{ __('messages.No statuses yet ...') }}</th>
                    @endif
                    </tbody>
                  </table>
              </div>
        </div>
    </div>
</div>
@endsection