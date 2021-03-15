@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __('messages.Edit label') }}</h2>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PUT'])}}
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
        </div>
    </div>
</div>
@endsection