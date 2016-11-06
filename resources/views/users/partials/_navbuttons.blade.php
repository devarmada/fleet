<nav class="navbar navbar-static-top">
  <div class="container">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
              <a class="btn btn-primary" href="{{ route('users.add_group', $user->id, array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> Add group(s) association
              </a>
              <a class="btn btn-primary" href="{{ route('users.index') }}">
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
