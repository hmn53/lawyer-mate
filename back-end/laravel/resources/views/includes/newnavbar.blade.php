<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="#">Web Portal for Lawyers</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div
            class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active" role="presentation">
                    @auth
                        <a class="nav-link " href="/dashboard">Home</a>
                    @endauth
                    @guest
                        <a class="nav-link" href="/">Home</a>
                    @endguest
                    
                </li>
                <li class="nav-item" role="presentation">
                    @auth
                        <a class="nav-link " href="/cases">cases</a>
                    @endauth
                    @guest
                        
                    @endguest
                </li>
                <li class="nav-item" role="presentation">
                    @auth
                    <a class="nav-link " href="/clients">clients</a>
                    @endauth
                    @guest
                        
                    @endguest
                    
                </li>
                <li class="nav-item" role="presentation">
                    @auth
                    <a class="nav-link " href="/docs">docs</a>
                    @endauth
                    @guest
                        
                    @endguest
                    
                </li>
                <li class="nav-item" role="presentation">
                    
                    @auth
                    <a class="nav-link " href="/reminder">reminder</a>
                    @endauth
                    @guest
                        
                    @endguest
                </li>
                <li class="nav-item dropdown dropdown-notifications">
                    @auth
                    {{-- <a class="nav-link " href="/inbox">inbox</a> --}}
                        
                    <div class="dropdown" style="float: right;margin-top:7px;">
                        <a href="#" onclick="return false;" role="button" data-toggle="dropdown" id="dropdownMenu1" data-target="#" style="float: left" aria-expanded="true">
                            <i class="fa fa-bell-o" style="font-size: 20px; float: left;color:darkslategray">
                            </i>
                        </a>
                        <span class="badge">0</span>
                        <ul class="dropdown-menu dropdown-menu-left pull-right" role="menu" aria-labelledby="dropdownMenu1">
                            <ul class="timeline timeline-icons timeline-sm" style="margin:6px;width:210px;list-style-type: none;">
                            </ul>
                        </ul>
                    </div>
                    {{-- <a href="#notifications-panel" id="navbarDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" >
                          <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>
                        <div class="dropdown-container">
                          <div class="dropdown-toolbar">
                            <div class="dropdown-toolbar-actions">
                              <a href="#">Mark all as read</a>
                            </div>
                            <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
                          </div>
                          <ul class="dropdown-menu">
                          </ul>
                          <div class="dropdown-footer text-center">
                            <a href="#">View All</a>
                          </div>
                        </div> --}}
                    
                    @endauth
                    @guest
                        
                    @endguest
                    
                </li>
                @guest
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/login">login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/register">signup</a>
                    </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right"style="text-align:center" aria-labelledby="navbarDropdown">
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="....">
                        <a class=" nav-link dropdown-item" href="/profile">
                            Profile
                        {{-- onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }} --}}
                         </a>
                        </div>
                       
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="....">
                         <a class=" nav-link dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                    </div>
                </li>
                @endguest
               
            </ul>
    </div>
    </div>
</nav>
