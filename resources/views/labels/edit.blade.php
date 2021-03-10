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
            {{Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'd-flex justify-content-center flex-column flex-md-row'])}}
                {{Form::text('name', $value = old('name'), ['class' => 'form-control form-control-lg d-block d-md-block mb-3 mb-md-0', 'placeholder' => 'Введите статус'])}}
                {{Form::submit(__('messages.Refresh'), ['class' => 'btn btn-lg btn-primary ms-md-3 px-5 text-uppercase'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection