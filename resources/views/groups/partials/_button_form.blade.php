<div class="form-group">
<!--    <a class="btn btn-primary" href="{{ route('fleet_lists.index') }}">-->
    <a class="btn btn-primary" href="{{ Session::get('backUrl') }}">
        <span class="glyphicon glyphicon-hand-left"></span> Back
    </a>
    {!! Form::button('<span class="glyphicon glyphicon-ok"></span> '.$submit_text, array('class' => 'btn btn-primary', 'type' => 'submit')) !!}
</div>
