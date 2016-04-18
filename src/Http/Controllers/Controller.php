<?php

namespace JanDolata\TranslationsEditor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JanDolata\TranslationsEditor\Engine\TranslationApi;
use View;

/**
 * Controller for translation
 * @author Jan Dolata <j.dolata@holonglobe.com>
 */
class Controller extends Controller
{

    /**
     * Show list of all or selected translation
     */
    public function get($file = 'all')
    {
        $data = (new TranslationApi)->get($file);
        return view('index', $data);
    }

    /**
     * Save translation
     * @param  Request $request
     */
    public function save(Request $request)
    {
        (new TranslationApi)->save($request);
        return redirect()
            ->route('translation_get', ['file' => $request->input('file')])
            ->with('info', trans('api.done'));
    }

    /**
     * Show Log
     */
    public function log()
    {
        $data = (new TranslationApi)->log();
        return view('log', $data);
    }
}
