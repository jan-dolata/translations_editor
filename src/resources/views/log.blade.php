@extends('layout')

@section('content')

<table class="table table-condensed table-hover">
    @foreach ($log as $index => $item)
        <tr>
            <td>
                <div class="m-sm-b" role="button" data-toggle="collapse" href="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                    {{ $item['name'] }}
                    <small class="pull-right">
                        {{ $item['time'] }}
                    </small>
                </div>
                <pre class="collapse" id="collapse{{ $index }}">{{ var_export($item['content']) }}</pre>
            </td>
        </tr>
    @endforeach
</table>

@endsection