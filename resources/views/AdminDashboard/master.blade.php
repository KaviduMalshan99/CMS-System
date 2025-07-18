@auth
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description"
                content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
            <meta name="keywords"
                content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
            <meta name="author" content="pixelstrap">
            <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
            <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
            <title></title>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            <!-- Google font-->
            <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
                rel="stylesheet">
            <link
                href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
                rel="stylesheet">



                {{-- <link rel="stylesheet" href="{{ asset('assets/css/test.css') }}"> --}}
                <!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/css/vendors/icofont.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendors/themify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

<!-- Plugins -->
<link rel="stylesheet" href="{{ asset('assets/css/vendors/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendors/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendors/animate.css') }}">

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

<!-- App Style -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">

<!-- Responsive -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">



            <!-- Report-->
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

            <!-- DataTables CSS and JS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

            <!-- DataTables Buttons CSS and JS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

            <!-- PDFMake and JSZip for PDF/Excel export -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

            {{-- report end  --}}

            @include('AdminDashboard.css')
            @yield('style')
        </head>



        <body onload="startTime()">
            @if (Route::current()->getName() == 'index')
                onload="startTime()"
            @elseif (Route::current()->getName() == 'button-builder')
                class="button-builder"
            @endif>
            <!-- loader starts-->
            <div class="loader-wrapper">
                <div class="loader-index"> <span></span></div>
                <svg>
                    <defs></defs>
                    <filter id="goo">
                        <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                        <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                        </fecolormatrix>
                    </filter>
                </svg>
            </div>
            <!-- loader ends-->
            <!-- tap on top starts-->
            <div class="tap-top"><i data-feather="chevrons-up"></i></div>
            <!-- tap on tap ends-->
            <!-- page-wrapper Start-->
            <div class="page-wrapper compact-wrapper" id="pageWrapper">


                @include('AdminDashboard.header')
                <!-- Page Body Start-->
                <div class="page-body-wrapper">
                    @include('AdminDashboard.sidebar')

                    <div class="page-body">
                        <div class="container-fluid">
                            <div class="page-title">
                                <div class="row">
                                    <div class="col-6">
                                        @yield('breadcrumb-title')
                                    </div>
                                    <div class="col-6">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="">
                                                    <svg class="stroke-icon">
                                                        <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}">
                                                        </use>
                                                    </svg></a></li>
                                            </li>
                                            @yield('breadcrumb-items')
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                @if (session('success'))
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "{{ session('success') }}",
                                        icon: 'success',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer);
                                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                                        }
                                    });
                                @endif

                                @if (session('error'))
                                    Swal.fire({
                                        title: 'Error!',
                                        text: "{{ session('error') }}",
                                        icon: 'error',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer);
                                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                                        }
                                    });
                                @endif
                            });

                            function confirmDelete(formId, message) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: message || "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'Cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById(formId).submit();
                                    }
                                });
                            }
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    </div>
                    @include('AdminDashboard.footer')
                </div>
            </div>

            @include('AdminDashboard.script')
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> to access your account.</p>

            <script>
                window.location.href = "{{ route('login') }}";
            </script>

        @endauth

    </body>

</html>
