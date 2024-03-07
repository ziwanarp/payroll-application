<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-06 16:27:42 +0200 -->
    <title>{{ $title }}</title>
    <link href="./assets/css/profile.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ url('/assets/js/require.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <link href="{{ url('/assets/css/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ url('/assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <link href="{{ url('/assets/plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ url('/assets/js/dashboard.js') }}"></script>
    <script src="{{ url('/assets/plugins/charts-c3/plugin.js') }}"></script>
    <script src="{{ url('/assets/plugins/maps-google/plugin.js') }}"></script>
    <script src="{{ url('/assets/plugins/input-mask/plugin.js') }}"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        
        @include('user.templates.header.navbar')
        
        <div class="my-3 my-md-5">
          <div class="container">

            @yield('body')

          </div>
        </div>
      </div>
        
      @include('user.templates.footer.footer')

    </div>
    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            
            const timeString = `${hours}:${minutes}:${seconds}`;
            
            document.getElementById('clock').textContent = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Get access to the webcam
        function openCam(){
          navigator.mediaDevices.getUserMedia({ video: true })
              .then(function(stream) {
                  var video = document.getElementById('webcam');
                  videoStream = stream;
                  video.srcObject = stream;
              })
              .catch(function(err) {
                var captureButton = document.getElementById('capture');
                captureButton.classList.remove('btn-success');
                captureButton.classList.add('btn-secondary');
                captureButton.disabled = true;
              });
        }

        // Capture image from webcam
        $(document).ready(function() {
            var video = document.getElementById('webcam');
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var capturedImage = document.getElementById('capturedImage');
            var location = null;
            // var captureButton = document.getElementById('capture');

            // get location
            navigator.geolocation.getCurrentPosition(
                  function (position) {
                     location = position.coords.latitude+','+position.coords.longitude;
                  },
                  function (error) {
                      location = null;
                  }
              );

            $("#stopCapture").on("click", function(){
              if (videoStream) {
                  var tracks = videoStream.getTracks();
                  tracks.forEach(function(track) {
                      track.stop();
                  });
                }
            });
        
            $("#capture").on("click", function(){
              var status = $(this).attr('value');

                // Draw the current frame of the video on the canvas
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Convert canvas data to base64 image data
                var imageData = canvas.toDataURL('image/png');
        
                // Display the captured image
                capturedImage.src = imageData;
                capturedImage.style.display = 'block';
        
                // Send the image data to the server
                $.ajax({
                    type: 'POST',
                    url: '/capture',
                    data: { _token: $('meta[name="csrf-token"]').attr('content'),
                            image: imageData,
                            location: location,
                            status: status },
                    success: function(response) {
                        var res = JSON.parse(response);

                        console.log(res);

                        if(res.success == true){
                          window.location.href = '/capture/success?status='+status;
                        } else {
                          alert(res.message);
                          $('#stopCapture').click()
                          $('#capturedImage').remove();

                        }

                    },
                    error: function(error) {
                        // window.location.href = '/capture/failed';
                    }
                  });
            });
          });
    </script>
  </body>
</html>