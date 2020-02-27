<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Portal for Lawyers</title>

    {{-- <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .container{margin-top: 50px;}
        body{
            background-image: url("/public/images/photo.jpg")
        }
</style>    --}}
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-notifications.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap2.min.css')}}"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/material-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="{{asset('css/smoothproducts.css')}}">
    <link rel="stylesheet" href="{{asset('css/notification.css')}}">
    {{-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> --}}


</head>
<body>
        {{-- @include('includes/navbar') --}}
        @include('includes/newnavbar')
        <?php
          use App\Directory;
        ?>
            @yield('content')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="{{asset('js/smoothproducts.min.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (Auth::check())
      <script type="text/javascript">
      var notificationsWrapper   = $('.dropdown-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = $(".badge");
      var notificationsCount     = parseInt(notificationsCountElem.text());
      var notifications          = notificationsWrapper.find('ul.timeline');
    //   localStorage.setItem('notifications',"");
    //   localStorage.setItem('count',"0");
      if(localStorage.getItem('notifications')){
        notifications.html(localStorage.getItem('notifications'));
        notificationsCount = parseInt(localStorage.getItem('count'));
        notificationsCountElem.text(notificationsCount);
      }else{
        notificationsWrapper.hide();
      }
      //console.log(localStorage.getItem('count'));
     function classChange(){
      if (notificationsCount <= 0) {
        //notificationsWrapper.hide();
        notificationsCountElem.addClass("badge-success");
      }else{
        notificationsCountElem.addClass("badge-danger");
      }
     }
     classChange();
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('0310106227f73c35189b', {
        cluster: 'ap2',
        encrypted:true,
        forceTLS: true
      });

      // Subscribe to the channel we specified in our Laravel Event
      var user = <?php echo auth()->user()->id ; ?>;
      var channel = pusher.subscribe('reminder-added-'+user);
      var description;
      console.log('reminder-added-'+user);

      // Bind a function to a Event (the full Laravel class)
      channel.bind('App\\Events\\ReminderAdded', function(data) {
        var existingNotifications = notifications.html();
        this.description = data.description;
        console.log(data);
        var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
                <div class="media-body">
                  <strong class="notification-title"><a class="title-not" style="text-decoration: none; color:grey"href="#" id="onclick">`+data.message+`</a></strong>
                  <!--p class="notification-desc">Extra description can go here</p-->
                  <div class="notification-meta">
                    <small class="timestamp">`+data.date+`</small>
                  </div>
                </div>
              </div
  >
          </li>
        `;

        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.text("");
        notificationsCountElem.text(notificationsCount);
        classChange();
        //notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
        localStorage.setItem("notifications", notifications.html());
        localStorage.setItem('count',notificationsCount);
        $('.title-not').css("color", "black");
        $(document).on("click","#onclick",function(){
     //alert(data.description);
     swal("Reminder",description, "info");
     $('.title-not').css("color", "grey");
     if(notificationsCount>0)
     {
       notificationsCount -=1;
       notificationsCountElem.text("");
            notificationsCountElem.text(notificationsCount);
       localStorage.setItem('count',notificationsCount);
       classChange();
      }
    });
        console.log("Notify: "+localStorage.getItem('notifications'));

      });

    </script>

    @endif

    <script>
        $(document).ready(function() {
        var pathname = window.location.pathname;
        $('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
        console.log(pathname);
        });
        
    </script>
    <script>
        
  $('.dataTables_length').addClass('bs-select');
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
  
      
      </script>

    <script>
      $(document).ready(function() {
        var showChar = 200;
        var ellipsestext = "......";
        var moretext = "show more";
        var lesstext = "show less";
        $('.more').each(function() {
          var content = $(this).html();

          if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar-1, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
          }

        });

        $(".morelink").click(function(){
          if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
          } else {
            $(this).addClass("less");
            $(this).html(lesstext);
          }
          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
        });
      });
    </script>

</body>
</html>
