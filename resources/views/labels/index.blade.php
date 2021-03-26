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
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->updated_at }}</td>
                        @auth
                        <td>
                            <a href="{{ route('labels.edit', ['label' => $label->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                {{ __('messages.edit') }}
                            </a>
                            <a href="{{ route('labels.destroy', ['label' => $label->id]) }}" data-confirm="{{ __('messages.Are you sure') }}" data-method="delete" rel="nofollow" class="btn btn-danger btn-sm float-left mr-1">
                              {{ __('messages.delete') }}
                            </a>
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
              {{ $labels->links() }}
        </div>
    </div>
</div>
@endsection