<div class="form-group">
    {{ Form::label(__('messages.Status'), $label, ['class' => 'control-label']) }}
    {{Form::select($name,  $list, $selected, array_merge_recursive(['class' => 'form-control'], $attributes))}}
</div>