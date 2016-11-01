@extends('layouts.app')

@section('content')
<style>
  .user-row {
    font-size: 0;
  }
  .user-row  > * {
      float: none;
      display: inline-block;
      font-size: 14px; /* if using LESS it's quicker to just use @font-size-base */
  }
  .user-row  > *:last-child {
      vertical-align: bottom;
  }
  .user-row  p:last-child {
      margin-bottom: 0; /* optional */
  }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User dashboard</div>

                  <div class="panel-body">
                    <h4>Your user data:</h4>
                    <div class="user-data">
                      <div class="row user-row">
                        <div class="col-xs-2">
                          User name:
                        </div>
                        <div class="col-xs-3">
                          <h2>{{ $user->name }}</h2>
                        </div>
                        <div class="col-xs-2">
                          email:
                        </div>
                        <div class="col-xs-5">
                          <h3>{{ $user->email }}</h3>
                        </div>
                      </div>

                      <div class="password-reset" style="margin-top: 2em;"">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/new') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                                <label for="oldpassword" class="col-md-4 control-label">Old password</label>

                                <div class="col-md-6">
                                    <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>

                                    @if ($errors->has('oldpassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oldpassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                                <label for="newpassword" class="col-md-4 control-label">New password</label>

                                <div class="col-md-6">
                                    <input id="newpassword" type="password" class="form-control" name="newpassword" required>

                                    @if ($errors->has('newpassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newpassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
                                <label for="newpassword-confirm" class="col-md-4 control-label">Confirm new password</label>

                                <div class="col-md-6">
                                    <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" required>

                                    @if ($errors->has('newpassword_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newpassword_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Set new password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <a class="btn btn-primary" href="{{ route('fleet_lists.index') }}">
                    <span class="glyphicon glyphicon-hand-left"></span> Back
                </a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                &nbsp;
            </ul>
        </div>
    </div>
</nav>
@endsection
