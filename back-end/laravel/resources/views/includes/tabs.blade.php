{{-- 

<style>
    /* Style the tab */
.tab {
  overflow: hidden;
  border: 2px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab a {
  background-color: inherit;
  float: left;
  border: 2px solid darkgray;
  border-bottom: 0px;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.tablinks{
    width:100%;
    
}
.col-sm{
    padding: 0%
}

.col-sm a:hover{
    background-color: #ddd;
}.col-sm .active{
    background-color: aqua;
}

</style>

<script>
    
    function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>

<div class="tab">
    <div class=row>
        <div class="col-sm">
            <a class="tablinks btn btn-default active" id="select" onclick="openCity(event, 'Home')">HOME</a>
        </div>
        <div class="col-sm">
            <a class="tablinks btn btn-default" onclick="openCity(event, 'Cases')">CASES</a>
        </div>
        <div class="col-sm">
            <a class="tablinks btn btn-default" onclick="openCity(event, 'Client')">CLIENT</a>
        </div>
        <div class="col-sm">
        <a class="tablinks btn btn-default" onclick="openCity(event, 'Docs')">DOCS</a>
        </div>
        <div class="col-sm">
        <a class="tablinks btn btn-default" onclick="openCity(event, 'Task')">TASK</a>
        </div>
        <div class="col-sm">
        <a class="tablinks btn btn-default" onclick="openCity(event, 'Inbox')"> INBOX</a>
        </div>
  </div>
</div>
  
  <!-- Tab content -->
  <div id="Home" class="tabcontent">
    <div class="jumbotron">
        <h1 class="display-4 d-flex justify-content-center">Welcome to Portal, {{ Auth::user()->name}}</h1>
        <div class="row d-flex justify-content-center" style="margin-top:40px">
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
  
  <div id="Cases" class="tabcontent">
    <h3>Paris</h3>
    <p>Paris is the capital of France.</p>
  </div>
  
  <div id="Client" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
  </div>
  <div id="Docs" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
  </div>
  <div id="Task" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
  </div>
  <div id="Inbox" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
  </div> --}}
<style>
  .custom{
    font-size: 20px;
    margin-right: 5px;
    border-right:2px solid #ccc;
    padding-right:20px !important;
    padding-left:20px !important;
  }
  </style>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="width:100%; margin-top:100px;justify-content:center;padding:0">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link custom" href="/dashboard">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom" href="/cases">Cases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom" href="/clients">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom" href="#">Documents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom" href="#">Inbox</a>
        </li>
      </ul>
    </div>
  </nav>
