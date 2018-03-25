<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

@include('frontend.theme.header')
  <!-- jQuery -->
  <script src="{{ URL::asset('/frontend/js/jquery.min.js') }}"></script>
<!-- end::Head -->
<!-- end::Body -->
@include('frontend.theme.left-slidebar')

@include('frontend.theme.header-bar')
<div class="px-content" style="">
    @yield('content')
</div>
@include('frontend.theme.footer-bar')

  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->


  <script src="{{ URL::asset('/frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('/frontend/js/pixeladmin.min.js') }}"></script>

  <script>
    // -------------------------------------------------------------------------
    // Initialize DEMO sidebar

    $(function() {
      pxDemo.initializeDemoSidebar();

      $('#px-demo-sidebar').pxSidebar();
      pxDemo.initializeDemo();
    });
  </script>

  <script type="text/javascript">
    // -------------------------------------------------------------------------
    // Initialize DEMO

    $(function() {
      var file = String(document.location).split('/').pop();

      // Remove unnecessary file parts
      file = file.replace(/(\.html).*/i, '$1');

      if (!/.html$/i.test(file)) {
        file = 'index.html';
      }

      // Activate current nav item
      $('body > .px-nav')
        .find('.px-nav-item > a[href="' + file + '"]')
        .parent()
        .addClass('active');

      $('body > .px-nav').pxNav();
      $('body > .px-footer').pxFooter();

      $('#navbar-notifications').perfectScrollbar();
      $('#navbar-messages').perfectScrollbar();
    });
  </script>
</body>
</html>
