<div class="form-group">
    <div class="form-label">
        {!! Form::label('name', 'User name:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('name', $name_value, array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <div class="form-label">
        {!! Form::label('description', 'Email:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('email', $email_value, array('class' => 'form-control')) !!}
    </div>
</div>
@include('users/partials/_group_form')
@include('users/partials/_button_form')
