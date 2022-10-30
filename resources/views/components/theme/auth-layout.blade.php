

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" />
    <title>Booking Application</title>
    <link rel="canonical" href="https://www.creative-tim.com/product/soft-ui-dashboard-tailwind" />
    <meta name="keywords"
        content="creative tim, html dashboard, html css dashboard, web dashboard, tailwind dashboard, tailwind, tailwindcss, tailwind css, css3 dashboard, tailwind admin, Soft UI Dashboard Tailwind, frontend, responsive tailwind dashboard, free dashboard, free admin dashboard, free tailwind admin dashboard">
    <meta name="description"
        content="Download Soft UI Tailwind CSS, a Free Tailwind CSS Admin Template developed by Creative Tim. Over 70 components, see the live demo on our site and join over 1,800,000 creatives!">
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Soft UI Tailwind CSS: Free Tailwind CSS Admin Template">
    <meta name="twitter:description"
        content="Download Soft UI Tailwind CSS, a Free Tailwind CSS Admin Template developed by Creative Tim. Over 70 components, see the live demo on our site and join over 1,800,000 creatives!">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image"
        content="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard/soft-ui-dashboard-tailwind.jpg">
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Soft UI Tailwind CSS: Free Tailwind CSS Admin Template">
    <meta property="og:description"
        content="Download Soft UI Tailwind CSS, a Free Tailwind CSS Admin Template developed by Creative Tim. Over 70 components, see the live demo on our site and join over 1,800,000 creatives!">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://demos.creative-tim.com/soft-ui-dashboard-tailwind/pages/dashboard.html" />
    <meta property="og:image"
        content="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard/soft-ui-dashboard-tailwind.jpg" />
    <meta property="og:site_name" content="Creative Tim" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/css/soft-ui-dashboard-tailwind.min.css?v=1.0.4')}}" rel="stylesheet" />

</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
   

    <nav
        class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
        <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
            <a class="py-2.375 text-sm mr-4 ml-4 whitespace-nowrap font-bold text-white lg:ml-0"
                href="../pages/dashboard.html"> Booking Application </a>
            @auth
            <div navbar-menu
                class="items-center justify-end flex-grow transition-all ease-soft duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-xl lg:flex lg:basis-auto">

                <ul class="hidden pl-0 mb-0 list-none lg:block lg:flex-row">
                    <li>
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-white" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="hidden sm:inline">
                                    <i class="fa fa-user mr-1"></i>
                                    {{ __('Log Out') }}
                                </span>
                            </a>

                            </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        {{ $slot }}

        <footer class="py-12">
            <div class="container">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
                        
                    </div>
                    <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
                        
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                        <p class="mb-0 text-slate-400">
                            Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            The Bantols
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    </main>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon='{"rayId":"76103eb6fdef2023","version":"2022.10.3","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}'
        crossorigin="anonymous"></script>
</body>

<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>

<script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.min.js?v=1.0.4') }}" async></script>

</html>
