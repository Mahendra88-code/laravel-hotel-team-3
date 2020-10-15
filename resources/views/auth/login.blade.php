<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="google-signin-client_id" content="191019778791-flmoe923g3f0eb8bkb3ucj4q8k3djl3n.apps.googleusercontent.com">
  <meta name="google-signin-cookiepolicy" content="single_host_origin">
  <meta name="google-signin-scope" content="profile email">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="base_url" content="{{ asset('') }}" />
  <title>
   HOTEL | SIGN IN
 </title>
 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 <!--     Fonts and icons     -->
 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
 <!-- CSS Files -->
 <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />
 <link href="{{ asset('assets/css/styles.css?pv=2.1.0')}}" rel="stylesheet" />
 <!-- <link href="{{ url('assets/css/styles.css?v=2.1.0')}}" rel="stylesheet" /> -->
</head>
<body class="off-canvas-sidebar">
  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" data-color="purple" filter-color="black" style="background-image: url('assets/img/login2.jpg'); background-size: cover; background-position: top center;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
          <div class="card card-login card-hidden">
            <form id="login-form" novalidate="novalidate">
              <div id="login-header" class="card-header card-header-warning text-center">
                <h4 class="card-title">Sign In</h4>
              </div>
              <div class="card-body">
                <span class="form-group bmd-form-group has-warning">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">face</i>
                      </span>
                    </div>
                    <input name="username" required="true" aria-required="true" type="text" class="form-control" placeholder="Username..." autocomplete="off">
                  </div>
                </span>
                <span class="form-group bmd-form-group has-warning">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <input name="password" required="true" aria-required="true" type="password" class="form-control" placeholder="Password..." autocomplete="off">
                  </div>
                </span>
                <div align="center">
                  <button type="submit" id="login-button" class="btn btn-warning btn-link btn-lg">Sign In</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.js')}}"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
<!-- Vector Map asgin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('assets/js/plugins/jquery-jvectormap.js')}}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('assets/js/plugins/nouislider.min.js')}}"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('assets/js/plugins/arrive.min.js')}}"></script>
<!-- Chartist JS -->
<script src="{{ asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/material-dashboard.js?v=2.1.0')}}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->       
<script>
  const BASE_URL = $("meta[name='base_url']").attr("content");
  const CSRF = $('meta[name="csrf-token"]').attr('content');

  $(document).ready(function() {
    md.checkFullPageBackgroundImage();
    setTimeout(function() {
      $('.card').removeClass('card-hidden');
    }, 700);
  });

  $('#login-form').submit(function (e) {
    e.preventDefault();
    var is_valid = $("#login-form").valid();
    if(is_valid) proses_login();
  });

  function show_notif(type, message) {

    $.notify({
      icon: "notification_important",
      message: "User is not valid"

    }, {
      type: "warning",
      timer: 3000,
      placement: {
        from: "top",
        align: "right"
      }
    });

  }

  function proses_login() {

    var object = {};
    object.headers = {};
    object.headers['X-CSRF-TOKEN'] = CSRF;
    object.url = `{{ route('postLogin') }}`;
    object.data = new FormData($('#login-form')[0]);
    object.type = 'POST';
    object.processData = false;
    object.contentType = false;
    object.success = function (result) {
      if(result.status == "success"){
        location.href = `${BASE_URL}${result.redirect_route}`;
        return;
      }

      show_notif("danger", "User is not valid")

    }

    $.ajax(object)
  }


  function setFormValidation(id) {
    $(id).validate({
      highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
        $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
      },
      errorPlacement: function(error, element) {
        error.addClass('pull-right').css('margin-top', '10px');
        $(element).closest('.form-group').append(error);
      },
    });
  }

  $(document).ready(function() {
    setFormValidation('#login-form');
  });
</script>
</body>

</html>
