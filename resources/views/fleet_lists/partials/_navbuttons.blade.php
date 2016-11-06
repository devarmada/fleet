<nav class="navbar navbar-static-top">
  <div class="container">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
              <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.create', $fleet_list->id, array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> New aircraft
              </a>
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
