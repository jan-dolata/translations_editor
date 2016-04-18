<!doctype html>

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.nav')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')
</body>

<script type="text/javascript">
    $(function() {
        $('.container').css('margin-top', parseInt($('.translation-nav').height()) + 40);
    });
</script>

</html>
