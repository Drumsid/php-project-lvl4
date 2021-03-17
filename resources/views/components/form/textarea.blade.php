<div class="form-group">
    {{ Form::label(__('messages.Description'), null, ['class' => 'control-label']) }}
    {{Form::textarea('description', $value = old('name'), ['class' => 'form-control'])}}
</div>