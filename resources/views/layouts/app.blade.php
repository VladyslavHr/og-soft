<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <meta name="author" content="Vladyslav Hrebennikov">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Playfair+Display" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
    <!-- CSS only -->

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.1.0/ol.css">

    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{ asset('css/datepicker/bootstrap-datepicker.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/dt-1.10.16/b-1.4.2/b-html5-1.4.2/datatables.min.css"/> --}}

    <link rel="stylesheet" href="{{ asset ('css/main.css?v=' . filemtime(public_path('css/main.css')) ) }}">

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

</head>

<body>
        @include('layouts.blocks.header')
        <main class="main-body">
            @yield('content')
            {{-- <a href="#" id="to_top" class="top-link" onchange="scroll()">Jump to top of page</a> --}}
        </main>
        @include('layouts.blocks.footer')
    {{-- </div> --}}
{{--
    @if (auth()->user())


    <a href="{{ route('checkout.index') }}" class="cart-link-main {{ Cart::isEmpty('d-none') }}"
    id="fixed_cart_link">
        <i class="bi bi-cart-check"></i>
        KOŠIK <b class="cart-count">{{ Cart::getTotalCount() }}</b>
    </a>
    @endif --}}

    <!-- JavaScript Bundle with Popper -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.3/dt-1.10.16/b-1.4.2/b-html5-1.4.2/datatables.min.js"></script> --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/splide.min.js') }}"></script> --}}
    {{-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script> --}}
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://kit.fontawesome.com/01db3a6801.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.min.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker/locales/bootstrap-datepicker.cs.min.js') }}"></script>
    {{-- @if($errors->any())
    @foreach($errors->all() as $error)
            <input type="hidden" class="form-error" value="{{ $error }}">
    @endforeach
    <script>
        $(function(){
            $('.form-error').each(function() {
                var error_message = $(this).val()
                toastr.error(error_message)
            })
        })
    </script>
    @endif --}}
    <script src="{{ asset ('js/main.js?v=' . filemtime(public_path('js/main.js')) ) }}"></script>

</body>
</html>
