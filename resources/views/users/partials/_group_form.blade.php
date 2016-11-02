<div class="form-group">
    <div class="form-label">
        {!! Form::Label('groups', 'Groups:') !!}
    </div>
    <div class="form-field">
      <select class="form-control" name="groups[]" size="{{ $groups->count() }}" multiple>
          @foreach($groups as $group)
          <option value="{{ $group->id }}" {{$group_values->where('id', $group->id)->count() > 0 ? "selected" : ""}}>
            {{ $group->name }}
          </option>
          @endforeach
      </select>
    </div>
</div>
