<?php

namespace JanDolata\TranslationsEditor\Engine;

use Illuminate\Http\Request;
use JanDolata\TranslationsEditor\Engine\Translation;

/**
 * Api for translation
 * @author Jan Dolata <j.dolata@holonglobe.com>
 */
class TranslationApi
{

    /**
     * Show list of all or selected translation
     */
    public function get($file = 'all')
    {
        $translation = new Translation;

        $files = $translation->getFiles();
        if (! in_array($file, $files))
            $file = 'all';

        $trans = $translation->getAll($file);
        $filesWithAll = array_merge(['all'], $files);
        $languages = $translation->getLanguages();
        $lastModified = $translation->lastModified($file);

        return [
            'translations' => $trans,
            'files' => $filesWithAll,
            'selected' => $file,
            'languages' => $languages,
            'lastModified' => $lastModified
        ];
    }

    /**
     * Save translation
     * @param  Request $request
     */
    public function save(Request $request)
    {
        $inputs = $request->all();
        $translation = new Translation;

        $trans = [];
        foreach ($translation->getLanguages() as $lang)
            $trans[$lang] = json_decode($inputs[$lang], true);

        $translation->saveForm($trans);
    }

    /**
     * Show Log
     */
    public function log()
    {
        $translation = new Translation;
        $files = $translation->getFiles();
        $filesWithAll = array_merge(['all'], $files);

        return [
            'log' => $translation->getLog(),
            'files' => $filesWithAll,
            'selected' => '',
        ];
    }
}
