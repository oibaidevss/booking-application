<!--
=========================================================
* Soft UI Dashboard Tailwind - v1.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset("assets/img/apple-icon.png") }}" />
    <link rel="icon" type="image/png" href=".{{ asset('assets/img/favicon.png') }}" />
    <title>Booking Application</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset("assets/css/soft-ui-dashboard-tailwind.css") }}" rel="stylesheet" />    
  </head>

  <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->
    @include('components.theme.partials.side-nav')   
    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
      <!-- Navbar -->
      @include('components.theme.partials.navbar')
      <!-- end Navbar -->

      <div class="w-full px-6 py-6 mx-auto">
        {{ $slot }}

        @include('components.theme.partials.footer')
      </div>

    </main>
    @include('components.theme.partials.configurator')

  </body>
  <!-- plugin for charts  -->
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}" async></script>
  <!-- plugin for scrollbar  -->
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}" async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- main script file  -->
  <script src="{{asset('assets/js/soft-ui-dashboard-tailwind.js')}}" async></script>
  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script>
      $("input[name=selectDate]").on("change", function (e) { 
          e.preventDefault();
          var link = $("#export").attr( 'data-href' );
          $("#export").attr( 'href', link + this.value );
      });

      console.log('test');
  </script>
</html>
