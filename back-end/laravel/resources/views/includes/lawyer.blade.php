<div class="container">
    <div class="jumbotron">
        <h1 class="display-4 d-flex justify-content-center">Welcome to Portal, {{ Auth::user()->name}}</h1>
        <div class="row d-flex justify-content-center" style="margin-top:60px">
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Case Requests</h5>
                      <p class="card-text">View all case related clients' requests</p>
                      <a href="/inbox" class="btn btn-primary">Inbox</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Important Docs</h5>
                      <p class="card-text">View all the documents</p>
                      <a href="/docs" class="btn btn-primary">Documents</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Lawbook</h5>
                      <p class="card-text">Read Lawbook here.</p>
                      <a href="/lawbook" class="btn btn-primary">Read</a>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center" style="margin-top:40px">
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">History</h5>
                      <p class="card-text">History of previous cases </p>
                      <a href="/cases/history" class="btn btn-primary">Check</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Current Case</h5>
                      <p class="card-text">Go to the current case.</p>
                      <a href="/cases/current" class="btn btn-primary">Go</a>
                    </div>
                  </div>
            </div>
            <div class="col-sm d-flex justify-content-center" >
                <div class="card" style="width: 18rem; display:none">
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