<title>TG - Translations</title>

<link rel="stylesheet" href="{{ asset(config('TranslationsEditor.bootstrapCssPath')) }}" type="text/css" />
<script type="text/javascript" src="{{ asset(config('TranslationsEditor.jqueryPath')) }}"></script>
<script type="text/javascript" src="{{ asset(config('TranslationsEditor.bootstrapJsPath')) }}"></script>
<link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}" type="text/css" />

<style type="text/css">
    body {
        overflow-y: scroll;
        font-family: sans-serif;
        background: #eee;
    }

    .translation-nav {
        position: fixed;
        border: 2px solid #f4f4f4;
        box-shadow: 3px 0 2px 2px rgba(0,0,50,0.3);
        background: #eee;

        top: 0;
        left: 0;
        right: 0;

        padding: 10px;
        width: 100%;
    }

    .container {
        margin-top: 74px;
    }

    .cell-50 {
        width: 50%;
    }
</style>
