<?php

/**
 * Translations
 */

$group = [];

$group['prefix'] = 'translation';

if(! empty(config('translations_editor.middleware')))
    $group['middleware'] = config('translations_editor.middleware');

if(! empty(config('translations_editor.routeParams'))) {
    foreach(config('translations_editor.routeParams') as $param => $value) {
        $group[$param] = $value;
    }
}

Route::group($group, function () {
    Route::get('get/{file?}', 'TranslationController@get')->name('translation_get');
    Route::post('save', 'TranslationController@save')->name('translation_save');
    Route::get('log', 'TranslationController@log')->name('translation_log');
});
