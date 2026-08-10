<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SMK Negeri 1 Tanjung Palas - @yield('title') </title>
  <link rel="icon" href="image/smk.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset ('Adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset ('Adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset ('Adminlte/dist/css/adminlte.min.css?v=3.2.0')}}">
</head>

<body class="hold-transition login-page">
  
      @yield('content')


  <script src="{{asset ('Adminlte/plugins/jquery/jquery.min.js')  }}"></script>
  <script src="{{asset ('Adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')  }}"></script>
  <script src="{{asset ('Adminlte/dist/js/adminlte.min.js?v=3.2.0')  }}"></script>
  <script src="{{asset ('Adminlte/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset ('Adminlte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script>
    $(function () {
      
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
            username: "Please enter a valid email address"
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
    </script>

</body>

</html>