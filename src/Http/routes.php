<?php

/**
 * Translations
 */

$group = [];

$group['prefix'] = 'translation';

if(! empty(config('translations_editor.middleware')))
    $group['middleware'] = config('translations_editor.middleware');

Route::group($group, function () {
    Route::get('get/{file?}', 'TranslationController@get')->name('translation_get');
    Route::post('save', 'TranslationController@save')->name('translation_save');
    Route::get('log', 'TranslationController@log')->name('translation_log');
});
