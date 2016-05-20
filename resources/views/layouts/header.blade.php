<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Amplify Social</a>
    </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="nav-collapse">
  @if(Auth::check())
    <ul class="nav navbar-nav">
      <!-- <li class="active"></li> -->
      <li>
        <a href="{{ url('/content') }}">
          <i class="fa fa-book" aria-hidden="true"></i> Content Library <span class="sr-only">(current)</span>
        </a></li>
      <li>
        <a href="{{ url('content/scheduled') }}"><i class="fa fa-list-ol" aria-hidden="true"></i> Scheduled Posts</a>
      </li>
      <li>
        <a href="{{ url('content/history') }}"><i class="fa fa-history" aria-hidden="true"></i> Post History</a>
      </li>
      <li><a href="{{ url('account/profiles') }}"><i class="fa fa-users" aria-hidden="true"></i> Social Profiles</a></li>
    </ul>
  @endif

<!--     <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form> -->

    <ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Login</a></li>
        <li><a href="{{ url('/register') }}">Register</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('account') }}"><i class="fa fa-cog" aria-hidden="true"></i>Manage</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </li>
    @endif

    </ul>
  </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>