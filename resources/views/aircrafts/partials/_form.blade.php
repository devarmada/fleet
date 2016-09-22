@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ Form::hidden('user_id', $user->id ) }}
{{ Form::hidden('fleet_list_id', $fleet_list->id ) }}
<div class="form-group">
    <div class="form-label">
        {!! Form::label('model', 'Model:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('model', $model_value, array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <div class="form-label">
        {!! Form::label('year', 'Year:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('year', $year_value, array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <div class="form-label">
        {!! Form::label('description', 'Description:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('description', $desc_value, array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <a class="btn btn-primary" href="{{ Session::get('backUrl') }}">
        <span class="glyphicon glyphicon-hand-left"></span> Back
    </a>
    {!! Form::button('<span class="glyphicon glyphicon-ok"></span> '.$submit_text, array('class' => 'btn btn-primary', 'type' => 'submit')) !!}
</div>
