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
<div class="form-group">
    <div class="form-label">
        {!! Form::Label('groups', 'Groups:') !!}
    </div>
    <div class="form-field">
      <select class="form-control" name="groups[]" multiple>
          @foreach($groups as $group)
          <option value="{{ $group->id }}" {{$group_values->where('id', $group->id)->count() > 0 ? "selected" : ""}}>
            {{ $group->name }}
          </option>
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
