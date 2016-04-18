<?php

/**
 * Translations
 */
Route::group(['prefix' => 'translation'], function () {
    Route::get('get/{file?}', 'TranslationController@get')->name('translation_get');
    Route::post('save', 'TranslationController@save')->name('translation_save');
    Route::get('log', 'TranslationController@log')->name('translation_log');
});
