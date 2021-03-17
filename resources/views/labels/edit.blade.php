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
                {{ Form::bsText(__('messages.Name')) }}
                {{ Form::bsTextarea(__('messages.Description')) }}
                {{Form::submit(__('messages.Refresh'), ['class' => 'btn btn-primary'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection