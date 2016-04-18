<?php

/**
 * Translations
 */
Route::group(['prefix' => 'translation'], function () {
    Route::get(
            'get/{file?}',
            'JanDolata\TranslationsEditor\Http\Controllers\Controller@get')
        ->name('translation_get');

    Route::post(
            'save',
            'JanDolata\TranslationsEditor\Http\Controllers\Controller@save')
        ->name('translation_save');

    Route::get(
            'log',
            'JanDolata\TranslationsEditor\Http\Controllers\Controller@log')
        ->name('translation_log');
});
