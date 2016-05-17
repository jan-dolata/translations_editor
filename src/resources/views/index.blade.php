@extends('TranslationsEditor::layout')

@section('content')

@if (! empty($translations))
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th class="cell-50">
                    # ({{ count($translations) }})
                </th>
                @foreach ($translations[0]->trans as $lang => $trans)
                    <th>
                        {{ strtoupper($lang) }}
                        <small class="text-muted">{{ $lastModified[$lang] }}</small>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($translations as $index => $translation)
                <tr>
                    <td class="cell-50">
                        <small class="text-muted">
                            {{ $index + 1 }}. {{ $translation->key }}
                        </small>
                        <br>
                        {{ $translation->base }}
                    </td>
                    @foreach ($translation->trans as $lang => $trans)
                        <td>
                            <textarea class="input-sm form-control transInput" data-lang="{{ $lang }}" data-key="{{ $translation->key }}" >{{ str_replace('&', '&amp;', $trans) }}</textarea>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="saveTranslation" action="{{ route('translation_save') }}" method='POST' autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="file" value="{{ $selected }}" />

        @foreach ($languages as $lang)
            <input type="hidden" name="{{ $lang }}" id="langInput_{{ $lang }}" />
        @endforeach
    </form>

    <script type="text/javascript">
        $(function() {
            $('#save').show(100);

            var languages = {!! json_encode($languages) !!};

            $('#save').click(function () {
                for(var i in languages) {
                    var lang = languages[i];
                    var list = {};

                    $.each($('.transInput'), function() {
                        var $item = $(this);
                        if ($item.data('lang') == lang)
                            list[$item.data('key')] = $item.val();
                    });

                    $('#langInput_' + lang).val( JSON.stringify(list) );
                }
                $('#saveTranslation').submit();
            });
        })
    </script>
@endif

@if (empty($translations))
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>
                    # (0)
                </th>
            </tr>
        </thead>
    </table>
@endif

@endsection
