{{ Form::hidden('user_id', $current_user->id ) }}
{{ Form::hidden('aircraft_id', $aircraft->id ) }}
<div class="form-group">
    <div class="form-label">
        {!! Form::label('title', 'Title:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('title', $title_value, array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <div class="form-label">
        {!! Form::label('file_name', 'File:') !!}
    </div>
    <div class="form-field">
        {!! Form::file('file_name') !!}
    </div>
</div>
<div class="form-group">
    <a class="btn btn-primary" href="{{ Session::get('backUrl') }}">
        <span class="glyphicon glyphicon-hand-left"></span> Back
    </a>
    {!! Form::button('<span class="glyphicon glyphicon-ok"></span> '.$submit_text, array('class' => 'btn btn-primary', 'type' => 'submit')) !!}
</div>
