<script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('asset/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('asset/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('asset/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('asset/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('asset/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('asset/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('asset/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('asset/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('asset/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('asset/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('asset/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script>
    $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   </script>
   <script>
const passwordFieldlama = document.getElementById("passwordlama");
const togglePasswordlama = document.querySelector(".passwordlama-toggle-icon i");


togglePasswordlama.addEventListener("click", function () {
  if (passwordFieldlama.type === "password") {
    passwordFieldlama.type = "text";
    togglePasswordlama.classList.remove("fa-eye");
    togglePasswordlama.classList.add("fa-eye-slash");
  } else {
    passwordFieldlama.type = "password";
    togglePasswordlama.classList.remove("fa-eye-slash");
    togglePasswordlama.classList.add("fa-eye");
  }
});
const passwordFieldbaru1 = document.getElementById("passwordbaru1");
const togglePasswordbaru1 = document.querySelector(".passwordbaru1-toggle-icon i");
togglePasswordbaru1.addEventListener("click", function () {
  if (passwordFieldbaru1.type === "password") {
    passwordFieldbaru1.type = "text";
    togglePasswordbaru1.classList.remove("fa-eye");
    togglePasswordbaru1.classList.add("fa-eye-slash");
  } else {
    passwordFieldbaru1.type = "password";
    togglePasswordbaru1.classList.remove("fa-eye-slash");
    togglePasswordbaru1.classList.add("fa-eye");
  }
});
const passwordFieldbaru2 = document.getElementById("passwordbaru2");
const togglePasswordbaru2 = document.querySelector(".passwordbaru2-toggle-icon i");
togglePasswordbaru2.addEventListener("click", function () {
  if (passwordFieldbaru2.type === "password") {
    passwordFieldbaru2.type = "text";
    togglePasswordbaru2.classList.remove("fa-eye");
    togglePasswordbaru2.classList.add("fa-eye-slash");
  } else {
    passwordFieldbaru2.type = "password";
    togglePasswordbaru2.classList.remove("fa-eye-slash");
    togglePasswordbaru2.classList.add("fa-eye");
  }
});
    </script>
