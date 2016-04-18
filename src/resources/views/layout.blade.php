<!doctype html>

<head>
    @include('TranslationsEditor::partials.head')
</head>

<body>
    @include('TranslationsEditor::partials.nav')

    <div class="container">
        @yield('content')
    </div>

    @include('TranslationsEditor::partials.footer')
</body>

<script type="text/javascript">
    $(function() {
        $('.container').css('margin-top', parseInt($('.translation-nav').height()) + 40);
    });
</script>

</html>
