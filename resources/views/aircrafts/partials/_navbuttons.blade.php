<nav class="navbar navbar-static-top">
  <div class="container">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            @if($show_note_button)
              <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.notes.create', [$fleet_list->id, $aircraft->id], array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> New note
              </a>
            @endif
            @if($show_attachment_button)
              <a class="btn btn-primary" href="{{ route('fleet_lists.aircrafts.attachments.create', [$fleet_list->id, $aircraft->id], array('class' => 'btn btn-info')) }}">
                  <span class="glyphicon glyphicon-plus"></span> New attachment
              </a>
            @endif
            <a class="btn btn-primary" href="{{ route('fleet_lists.show', $fleet_list) }}">
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
