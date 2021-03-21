@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-5">{{ __('messages.Statuses') }}</h2>
            @auth
              <a class="btn btn-primary mb-5" href="{{ route('task_statuses.create') }}" role="button">{{ __('messages.Add status') }}</a>
            @endauth
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.Date of creation') }}</th>
                        @auth
                          <th scope="col">{{ __('messages.Actions') }}</th>
                        @endauth
                      </tr>
                    </thead>
                    @if (count($taskStatuses))
                    <tbody>
                        @foreach($taskStatuses as $status)    
                      <tr>
                        <th>{{ $status->id }}</th>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->updated_at }}</td>
                        @auth
                        <td>
                            <a href="{{ route('task_statuses.edit', ['task_status' => $status->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('task_statuses.destroy', ['task_status' => $status->id]) }}" method="post" class="float-left">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Подтвердите удаление')">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
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
              {{ $taskStatuses->links() }}
        </div>
    </div>
</div>
@endsection