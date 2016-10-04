{{ Form::hidden('user_id', $user->id ) }}
<div class="form-group">
    <div class="form-label">
        {!! Form::label('name', 'Name:') !!}
    </div>
    <div class="form-field">
        {!! Form::text('name', $name_value, array('class' => 'form-control')) !!}
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
    <div class="form-label">
        {!! Form::Label('groups', 'Groups:') !!}
    </div>
    <div class="form-field">
        <select class="form-control" name="group_id">
            @foreach($groups as $group)
            <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
<!--    <a class="btn btn-primary" href="{{ route('fleet_lists.index') }}">-->
    <a class="btn btn-primary" href="{{ Session::get('backUrl') }}">
        <span class="glyphicon glyphicon-hand-left"></span> Back
    </a>
    {!! Form::button('<span class="glyphicon glyphicon-ok"></span> '.$submit_text, array('class' => 'btn btn-primary', 'type' => 'submit')) !!}
</div>
