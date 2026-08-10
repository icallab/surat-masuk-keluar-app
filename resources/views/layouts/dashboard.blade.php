<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SMK Negeri 1 Tanjung Palas</title>
    <link rel="icon" href="image/smk.png">
    

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('Adminlte/plugins/tempusdominus-bootstrap-4/css/te') }}mpusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/icheck-bootstrap/icheck-bootstra') }}p.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/overlayScrollbars/css/OverlayScr') }}ollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/daterangepicker/daterangepicker.') }}css">

    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('Adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- summernote -->

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

  
  

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css"
        integrity="sha256-7jUS+MWeqkFdmW9ozkZ7mPagz+QmMbsBlt+Q3MsE+FU=" crossorigin="anonymous">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 181px!important">

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="dropdown-item">

                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar

                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <!-- Message End -->
                    </a>

                </li>
                <!-- Notifications Dropdown Menu -->

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="image/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light d-block">{{ Auth::user()->name }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                        <li class="nav-item ">
                            <a href="/" class="nav-link {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>
                        @if (Auth::user()->level == 'kepsek' || Auth::user()->level == 'tatausaha')
                        <li class="nav-item ">
                            <a href="{{ route('surat_masuk') }}"
                                class="nav-link {{ 'surat-masuk' == request()->path() ? 'active' : '' }}  {{ 'surat-detail{id}' == request()->path() ? 'active' : '' }}  ">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Surat Masuk
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('surat_keluar') }}"
                                class="nav-link {{ 'surat-keluar' == request()->path() ? 'active' : '' }}">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>
                                    Surat Keluar
                                </p>
                            </a>
                        </li>
                       
                        
                            <li class="nav-item">
                                <a href="{{ route('disposisi') }}"
                                    class="nav-link {{ 'disposisi' == request()->path() ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-envelope-open"></i>
                                    @if (Auth::user()->level == 'kepsek')
                                    <p>Disposisi</p>
                                    @endif
                                    @if (Auth::user()->level !== 'kepsek')
                                    <p>Disposisi Masuk</p>
                                    @endif
                                </a>
                            </li>
                       

                        @if (Auth::user()->level == 'tatausaha')
                            <li class="nav-item">
                                <a href="{{ route('form_tipe') }}"
                                    class="nav-link {{ 'tipe-create' == request()->path() ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-server"></i>
                                    <p>
                                        Tipe Surat
                                    </p>
                                </a>
                            </li>
                       
                            <li class="nav-item">
                                <a href="{{ route('form_user') }}"
                                    class="nav-link {{ 'users-baca' == request()->path() ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Manajemen User
                                    </p>
                                </a>
                            </li>
                            @endif

                        

                        <li
                            class="nav-item has-treeview {{ Request::is('laporan-masuk', 'laporan-keluar', 'laporan-disposisi') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Request::is('laporan-masuk', 'laporan-keluar', 'laporan-disposisi') ? 'active' : '' }} ">
                                <i class="nav-icon fas fa fa-file"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul
                                class="nav nav-treeview {{ Request::path() == 'laporan-masuk', 'laporan-keluar', 'laporan-disposisi' ? 'menu-open' : '' }} ">
                                <li class="nav-item ">
                                    <a href="laporan-masuk"
                                        class="nav-link {{ Request::is('laporan-masuk') ? 'active' : '' }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Surat Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="laporan-keluar"
                                        class="nav-link {{ Request::is('laporan-keluar') ? 'active' : '' }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Surat Keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="laporan-disposisi"
                                        class="nav-link {{ Request::is('laporan-disposisi') ? 'active' : '' }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Disposisi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>


        <div class="content-wrapper">
            @if (session()->has('message'))
            <a type="hidden" id="myLink" href='#' onclick="succes();"></a>
            @endif
            @if (session()->has('delete'))
            <a type="hidden" id="delete" href='#' onclick="deletefun();"></a>
            @endif
            @yield('content')
        </div>
    </div>


    <footer class="main-footer">
        <strong>Copyright &copy; SMK Negeri 1 Tanjung Palas </a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">

        </div>
    </footer>








    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->


    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('Adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('Adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 4 -->
    <script src="{{ asset('Adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('Adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('Adminlte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('Adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('Adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('Adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('Adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('Adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Adminlte/dist/js/adminlte.js') }}"></script>

    {{--     
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
   
   
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> --}}

    <script src="{{ asset('Adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('Adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>






    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
              'use strict';
              window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                  form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                  }, false);
                });
              }, false);
            })();
            </script>
    {{-- <script>
        function confirm(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("hapus").submit();
                }
            })
        }
    </script> --}}
    <script>
        function hapus() {
  confirm("Anda Yakin!");
}
    </script>
{{-- <script>
    function deletefun() {
        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
    }
    $(document).ready(function(){
          $('#delete').click();
    });
</script> --}}
    {{-- <script>
        function succes() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            })
        }
        $(document).ready(function(){
          $('#myLink').click();
     });
    </script> --}}
    {{-- <script>
        $(function () {
          $.validator.setDefaults({
            submitHandler: function () {
              alert( "Form successful submitted!" );
            }
          });
          $('#quickForm').validate({
            rules: {
              username: {
                required: true,
              },
              password: {
                required: true,
                minlength: 5
              },
              terms: {
                required: true
              },
            },
            messages: {
              username: {
                required: "Please enter a email address",
                
              },
              password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
              },
              terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
          });
        });
        </script> --}}
</body>

</html>
