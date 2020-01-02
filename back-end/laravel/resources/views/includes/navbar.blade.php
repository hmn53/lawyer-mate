
<?php
    $user=auth()->user();
?>
<style>
    .nav-link{
        font-size: 17px;
    }
    .navbar-brand{
        font-size: 17px;
    }
    .active{
        color: rgba(255, 255, 255, 0.75);
    }
</style>
 <nav class="navbar navbar-expand-md navbar-dark bg-dark">
     @guest
     <a class="navbar-brand" href="/">Web Portal for Lawyers</a>
     @endguest
    @auth
    <a class="navbar-brand" href="/dashboard">Web Portal for Lawyers</a>
    @endauth
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              @guest
              <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
              @endguest
              @auth
              <a class="nav-link " href="/dashboard">Home <span class="sr-only">(current)</span></a>
              @endauth
          </li>
          <li class="nav-item">
            @auth
            @if (strcmp($user->type,"lawyer")==0)
                <a class="nav-link" href="lawbook">Lawbook <span class="sr-only">(current)</span></a>
            @else  
                <a class="nav-link" href="lawbook">Lawbook <span class="sr-only">(current)</span></a>
            @endif
            
            @endauth
        </li>
        <li class="nav-item">
        @guest
        <a class="nav-link " href="/services">Services</a>
        @endguest
        @auth
        <a class="nav-link " href="/cases">Cases</a>
        @endauth   
        </li>
        @auth
        <li class="nav-item">
            <a class="nav-link " href="/clients">Clients</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/docs">Documents</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/reminders">Reminders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/inbox">Inbox</a>
        </li>
        @endauth
      </ul>
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="....">
                            <i class="material-icons" style="margin-left:10px">
                            perm_identity
                            </i>
                       
                        
                        <a class="dropdown-item" href="/profile">
                            <h5>Profile</h5>
                        {{-- onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }} --}}
                         </a>
                        </div>
                       
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="....">
                            <i class="material-icons" style="margin-left:10px; margin-top:3px">
                                power_settings_new
                                </i>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <h5>Logout</h5>
                      </a>
                      
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                    </div>
                </li>
            @endguest
        </ul>
    
      <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
  </div>
</nav>
