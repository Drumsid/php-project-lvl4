<div class="form-group">
    {{ Form::label(__('messages.Name'), null, ['class' => 'control-label']) }}
    {{ Form::text('name', $value = old('name'), ['class' => 'form-control']) }}
  </div>