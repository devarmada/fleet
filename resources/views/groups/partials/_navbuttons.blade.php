<nav class="navbar navbar-static-top">
  <div class="container">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
              <a class="btn btn-primary" href="{{ route('groups.add_user', $group->id, array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> Add user(s) to the group
              </a>
              <a class="btn btn-primary" href="{{ route('groups.index') }}">
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
