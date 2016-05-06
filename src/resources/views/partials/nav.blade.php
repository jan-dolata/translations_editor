<div class="translation-nav">
    <a href="{{ config('translations_editor.backUrl') }}" class="btn btn-info">
        <i class="fa fa-home"></i>
    </a>
    <a href="{{ route('translation_log') }}" class="btn btn-info"  style="margin-right: 20px" >
        <i class="fa fa-archive" aria-hidden="true"></i>
    </a>

    <div class="btn-group">
        @foreach ($files as $name)
            <a href="{{ route('translation_get', ['file' => $name]) }}" class="btn btn-default {{ $name == $selected ? 'active' : '' }}">
                {{ $name }}
            </a>
        @endforeach
    </div>

    <button id="save" class="btn btn-success" style="display: none">
        <i class="fa fa-save"></i>
    </button>
</div>
