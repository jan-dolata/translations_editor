<?php

/**
 * Translations
 */

$group = [];

$group['prefix'] = 'translation';

if(! empty(config('TranslationsEditor.middleware')))
    $group['middleware'] = config('TranslationsEditor.middleware');

Route::group($group, function () {
    Route::get('get/{file?}', 'TranslationController@get')->name('translation_get');
    Route::post('save', 'TranslationController@save')->name('translation_save');
    Route::get('log', 'TranslationController@log')->name('translation_log');
});
