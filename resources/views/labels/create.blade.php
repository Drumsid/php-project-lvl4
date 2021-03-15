@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __('messages.Add new label') }}</h2>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::model($label, ['url' => route('labels.store'), 'method' => 'post'])}}
                <div class="form-group">
                  {{ Form::label(__('messages.Name'), null, ['class' => 'control-label']) }}
                  {{ Form::text('name', $value = old('name'), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                  {{ Form::label(__('messages.Description'), null, ['class' => 'control-label']) }}
                  {{Form::textarea('description', $value = old('name'), ['class' => 'form-control'])}}
                </div>
                {{Form::submit(__('messages.Сreate'), ['class' => 'btn btn-primary'])}}
            {{Form::close()}}

            {{Form::select('labels[]', ['1' => 1, '2' => 2, '3' => 3], ['1', '3'], ['class' => 'form-control', 'multiple'])}}
        </div>
    </div>
</div>
@endsection