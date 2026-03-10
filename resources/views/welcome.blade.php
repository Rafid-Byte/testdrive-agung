@include('components.welcome._head')

<body class="bg-gray-50 antialiased" x-data="bookingApp()">

    {{-- HEADER + NAV --}}
    @include('components.welcome._header')

    {{-- HERO SECTION --}}
    @include('components.welcome._hero')

    {{-- MAIN: DAFTAR KENDARAAN --}}
    @include('components.welcome._vehicles')

    {{-- MODAL: FORM BOOKING --}}
    @include('components.welcome.modals._booking')

    {{-- FOOTER --}}
    @include('components.welcome._footer')

    {{-- ALPINE.JS SCRIPT --}}
    @include('components.welcome._script')

    {{-- MODAL: DETAIL UNIT --}}
    @include('components.welcome.modals._unit')

</body>

</html>
