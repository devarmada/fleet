<div class="form-group">
    <div class="form-label">
        {!! Form::Label('users', 'Users to include:') !!}
    </div>
    <div class="form-field">
      <select class="form-control" name="users[]" size="{{ $users->count() }}" multiple>
          @foreach($users as $user)
          <option value="{{ $user->id }}" {{$user_values->where('id', $user->id)->count() > 0 ? "selected" : ""}}>
            {{ $user->name }}
          </option>
          @endforeach
      </select>
    </div>
</div>
