<div class="form-group">
    <div class="form-label">
        {!! Form::label('name', 'Group name:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('name', $name_value, array('class' => 'form-control')) !!}
    </div>
</div>
@include('groups/partials/_user_form')
@include('groups/partials/_button_form')
