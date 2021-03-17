<div class="form-group">
    {{ Form::label(__('messages.Status'), null, ['class' => 'control-label']) }}
    {{Form::select($name, $values, $value, ['class' => 'form-control'])}}
</div>