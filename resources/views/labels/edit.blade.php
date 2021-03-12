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
            {{-- {{Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'd-flex justify-content-center flex-column flex-md-row'])}}
                {{Form::text('name', $value = old('name'), ['class' => 'form-control form-control-lg d-block d-md-block mb-3 mb-md-0', 'placeholder' => 'Введите статус'])}}
                {{Form::submit(__('messages.Refresh'), ['class' => 'btn btn-lg btn-primary ms-md-3 px-5 text-uppercase'])}}
            {{Form::close()}} --}}
            {{-- <form method="post" action="{{route('labels.update', $label)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">{{ __('messages.Name') }}</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{$label->name}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ __('messages.Description') }}</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$label->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.Refresh')}}</button>
            </form> --}}
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