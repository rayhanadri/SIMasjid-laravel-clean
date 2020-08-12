<footer class="main-footer">
  <div class="footer-left">
    <!-- <button id="dark-mode-btn" class="btn btn-dark">Dark Mode</button><br> -->
    Copyright &copy; <?php echo date('Y'); ?> <div class="bullet"></div> SIMASJID Ibnu Sina Malang
  </div>
  <div class="footer-right">
    2.0.0
  </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- key popper js  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- key bootstrap js integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('public/dist/assets/js/stisla.js') }}"></script>

<!-- JS Libraries -->
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- <script src="{{ asset('public/dist/cleave.js/dist/cleave.min.js') }}"></script> -->
<!-- <script src="{{ asset('public/dist/cleave.js/dist/addons/cleave-phone.us.js') }}"></script> -->
<script src="{{ asset('public/dist/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('public/dist/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- <script src="{{ asset('public/dist/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script> -->
<script src="{{ asset('public/dist/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('public/dist/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('public/dist/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('public/dist/summernote/dist/summernote-bs4.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('public/dist/assets/js/scripts.js') }}"></script>
<!-- <script src="{{ asset('public/dist/assets/js/custom.js') }}"></script> -->

<!-- Page Specific JS File -->
<script type="text/javascript">
  //dark-mode
  $(document).ready(function() {
    $(document).on("click", "#dark-mode-switch", function() {
      $('body').toggleClass('dark-mode');
      $('.section-body').toggleClass('dark-mode');
      $('.section-header').toggleClass('dark-mode');
      $('.main-footer').toggleClass('white-font');
      $('tr').toggleClass('dark-mode');
      $('th').toggleClass('dark-mode');
      $('th').toggleClass('white-font');
      $('h1').toggleClass('white-font');
      $('table').toggleClass('dark-mode');
      // }
    });
    // $("#dark-mode-btn").toggle(function() {
    //   alert("First handler for .toggle() called.");
    // }, function() {
    //   alert("Second handler for .toggle() called.");
    // });
    // if ($('#checkbox-dark-mode').prop("checked") == true) {
    //   $('body').addClass('dark-mode');
    //   $('.section-body').addClass('dark-mode');
    //   $('.section-header').addClass('dark-mode');
    //   $('.main-footer').addClass('white-font');
    //   $('tr').addClass('dark-mode');
    //   $('th').addClass('dark-mode');
    //   $('th').addClass('white-font');
    //   $('h1').addClass('white-font');
    //   $('table').addClass('dark-mode');
    //   $('table').css('background-color', '#6c757d !important');
    // }
    // $('body').addClass('dark-mode');
    // $('.section-body').addClass('dark-mode');
    // $('.section-header').addClass('dark-mode');
    // $('.main-footer').addClass('white-font');
    // $('tr').addClass('dark-mode');
    // $('th').addClass('dark-mode');
    // $('th').addClass('white-font');
    // $('h1').addClass('white-font');
    // $('table').addClass('dark-mode');
    // $('table').css('background-color', '#6c757d !important');
    //
  });
</script>
</body>

</html>