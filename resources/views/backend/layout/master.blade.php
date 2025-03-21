<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Admin | @yield('title')</title>

    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('admin/assets/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('admin/assets/favicon.ico')}}">
    <meta name="theme-color" content="#3063A0"><!-- End FAVICONS -->
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/flatpickr/flatpickr.min.css')}}">

    {{-- Editors --}}
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/summernote/summernote-bs4.min.css')}}">
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{asset('admin/assets/stylesheets/theme.min.css')}}" data-skin="default">
    <link rel="stylesheet" href="{{asset('admin/assets/stylesheets/theme-dark.min.css')}}" data-skin="dark">
    <link rel="stylesheet" href="{{asset('admin/assets/stylesheets/custom.css')}}">
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        // Disable unused skin immediately
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        // add loading class to html immediately
        document.querySelector('html').classList.add('loading');
    </script><!-- END THEME STYLES -->

    @stack('custom_css')
</head>

<body>
    <!-- .app -->
    <div class="app">

        <!-- .app-header -->
        @include('backend.includes.topNav')

        <!-- .app-aside -->
        @include('backend.includes.sidebar')
        <!-- .app-main -->



        <main class="app-main">
            <!-- .wrapper -->
            <div class="wrapper">
                <!-- .page -->
                @yield('content')
            </div>

            <!-- .app-footer -->
            @include('backend.includes.footer')

            <!-- /.wrapper -->
        </main><!-- /.app-main -->



    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="{{asset('admin/assets/vendor/pace-progress/pace.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/stacked-menu/js/stacked-menu.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/flatpickr/flatpickr.min.js')}}"></script>
    {{--
    <script src="{{asset('admin/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js')}}"></script> --}}
    {{--
    <script src="{{asset('admin/assets/vendor/chart.js/Chart.min.js')}}"></script> <!-- END PLUGINS JS --> --}}

    <script src="{{asset('admin/assets/vendor/wnumb/wNumb.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/nouisliderribute/nouislider.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/blueimp-load-image/js/load-image.all.min.js')}}"></script>
    {{--
    <script src="{{asset('admin/assets/vendor/blueimp-canvas-to-blob/js/canvas-to-blob.min.js')}}"></script> --}}
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.fileupload-process.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.fileupload-image.js')}}"></script>
    {{--
    <script src="{{asset('admin/assets/javascript/pages/uploader-demo.js')}}"></script> --}}


    {{-- Editors --}}
    <script src="{{asset('admin/assets/vendor/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('admin/assets/javascript/pages/summernote-demo.js')}}"></script>
 
    {{--
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.fileupload-audio.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.fileupload-video.js')}}"></script> --}}
    <script src="{{asset('admin/assets/vendor/blueimp-file-upload/js/jquery.fileupload-validate.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <!-- BEGIN THEME JS -->
    <script src="{{asset('admin/assets/javascript/theme.min.js')}}"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    {{--
    <script src="{{asset('admin/assets/javascript/pages/dashboard-demo.js')}}"></script> <!-- END PAGE LEVEL JS --> --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-116692175-1');
    </script>

    @stack('custom_js')

</body>

</html>