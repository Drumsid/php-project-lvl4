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
            {{-- {{Form::model($label, ['url' => route('labels.store'), 'method' => 'post', 'class' => 'd-flex justify-content-center flex-column flex-md-row'])}}
                {{Form::text('name', $value = old('name'), ['class' => 'form-control form-control-lg d-block d-md-block mb-3 mb-md-0', 'placeholder' => __('messages.Enter label')])}}
                {{Form::submit(__('messages.Сreate'), ['class' => 'btn btn-lg btn-primary ms-md-3 px-5 text-uppercase'])}}
            {{Form::close()}} --}}

            <form method="post" action="{{route('labels.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">{{ __('messages.Name') }}</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ __('messages.Description') }}</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.Сreate')}}</button>
            </form>
        </div>
    </div>
</div>
@endsection