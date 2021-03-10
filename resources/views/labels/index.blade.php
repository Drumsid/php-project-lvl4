@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-5">{{ __('messages.Labels') }}</h2>
            @auth
              <a class="btn btn-primary mb-5" href="{{ route('labels.create') }}" role="button">{{ __('messages.Add label') }}</a>
            @endauth
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.Description') }}</th>
                        <th scope="col">{{ __('messages.Date of creation') }}</th>
                        @auth
                          <th scope="col">{{ __('messages.Actions') }}</th>
                        @endauth
                      </tr>
                    </thead>
                    @if (count($labels))
                    <tbody>
                        @foreach($labels as $label)    
                      <tr>
                        <th>{{ $label->id }}</th>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->updated_at }}</td>
                        @auth
                        <td>
                            <a href="{{ route('labels.edit', ['label' => $label->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('labels.destroy', ['label' => $label->id]) }}" method="post" class="float-left">
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
                    <th>{{ __('messages.No labels yet ...') }}</th>
                    @endif
                    </tbody>
                  </table>
              </div>
        </div>
    </div>
</div>
@endsection