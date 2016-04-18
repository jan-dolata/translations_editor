<?php

namespace JanDolata\TranslationsEditor\Engine;

use JanDolata\TranslationsEditor\Engine\TranslationModel;
use File;
use Config;
use Carbon\Carbon;

/**
 * Translation
 * @author Jan Dolata <j.dolata@holonglobe.com>
 */
class Translation
{
    /**
     * List of translation file names
     * @var array
     */
    private $files = [];

    /**
     * List of languages
     * @var array
     */
    private $languages = [];

    /**
     * @var string
     */
    private $keyJoiner = '.';

    /**
     * Fill empty trans with base value
     * @var boolean
     */
    private $fillEmpty = true;

    /**
     * Constructor
     * @param  boolean $fillEmpty = true - fill empty trans with base value
     */
    public function __construct($fillEmpty = true)
    {
        $this->languages = config('app.languages');

        foreach (File::allFiles($this->langPath() . '/base') as $file) {
            $this->files[] = basename($file->getPathname(), '.php');
        }

        $this->fillEmpty = $fillEmpty;
    }

    private function langPath()
    {
        return base_path() . '/resources/lang';
    }

    private function backupPath()
    {
        return storage_path() . '/app/translations';
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function getLanguages()
    {
        return $this->languages;
    }

    public function getFilePath($lang, $name)
    {
        return $this->langPath() . "/" . $lang . "/" . $name . ".php";
    }

    public function generateBackupFilePath($lang, $name)
    {
        return $this->backupPath() . "/" . $lang . "__" . $name . ".php" . time();
    }

    /**
     * Get list of TranslationModel for selected file or all
     * @param  string $fileName - name of file
     * @return array
     */
    public function getAll($fileName)
    {
        if (in_array($fileName, $this->files))
            return $this->getByFileName($fileName);

        $translations = [];
        foreach($this->files as $file) {
            $translations = array_merge($translations, $this->getByFileName($file));
        }

        return $translations;
    }

    /**
     * Get list of TranslationModel for selected file
     * @param  string $fileName - name of file
     * @return array
     */
    public function getByFileName($fileName)
    {
        $langTrans = [];
        foreach(array_merge(['base'], $this->languages) as $lang)
            $langTrans[$lang] = $this->prepareFileArray($lang, $fileName);

        $translations = [];
        foreach($langTrans['base'] as $key => $base) {
            $trans = [];
            foreach($this->languages as $lang)
                $trans[$lang] = $this->getValueIfExist($key, $langTrans[$lang], $base);

            $translations[] = new TranslationModel([
                'key' => $key,
                'base' => $base,
                'trans' => $trans
            ]);
        }

        return $translations;
    }

    /**
     * Return trans value if exist, $base value if $this->fillEmpty is true or empty string
     * @param  string $key
     * @param  array  $trans
     * @param  string $base
     * @return string
     */
    private function getValueIfExist($key, $trans, $base)
    {
        if(array_key_exists($key, $trans) && ! empty($trans[$key]))
            return $trans[$key];

        if($this->fillEmpty)
            return $base;

        return '';
    }

    /**
     * Prepare list of translation with special key
     * @param  $lang
     * @param  $fileName
     * @return array
     */
    public function prepareFileArray($lang, $fileName)
    {
        $trans = $this->getFile($lang, $fileName);
        $ritit = empty($trans)
            ? []
            : new \RecursiveIteratorIterator(new \RecursiveArrayIterator($trans));

        $result = [];
        foreach ($ritit as $leafValue) {
            $keys = [];
            $keys[] = $fileName;
            foreach (range(0, $ritit->getDepth()) as $depth) {
                $keys[] = $ritit->getSubIterator($depth)->key();
            }
            $result[ join($this->keyJoiner, $keys) ] = $leafValue;
        }

        return $result;
    }

    /**
     * Save translation in file
     * @param  $inputs - all form inputs
     */
    public function saveForm($inputs)
    {
        foreach($this->languages as $lang) {

            $files = [];
            foreach($inputs[$lang] as $key => $trans)
                $this->__assignArrayByPath($files, $key, $trans);

            foreach($files as $name => $content) {
                $filePath = $this->getFilePath($lang, $name);
                if(! file_exists($this->langPath() . '/' . $lang))
                    File::makeDirectory($this->langPath() . '/' . $lang, 0775, true);

                $oldContent = file_exists($filePath) ? file_get_contents($filePath) : '';
                $newContent = "<?php \nreturn " . var_export($content, true) . ";\n";

                if($oldContent != $newContent) {
                    $this->backupLangFile($lang, $name);
                    $res = file_put_contents($filePath, $newContent);
                    if ($res === false) throw new \Exception("Problem with writing language file ({$filePath})");
                }
            }
        }
    }

    private function __assignArrayByPath(&$arr, $path, $value)
    {
        $keys = explode($this->keyJoiner, $path);

        while ($key = array_shift($keys)) {
            $arr = &$arr[$key];
        }

        $arr = $value;
    }

    public function backupLangFile($lang, $name)
    {
        if (! file_exists($this->backupPath()))
            mkdir($this->backupPath(), 0777, true);

        $backupFile = $this->generateBackupFilePath($lang, $name);

        $path = $this->getFilePath($lang, $name);
        $res = file_exists($path)
            ? copy($path, $backupFile)
            : true;

        if ($res===false)
            throw new \Exception("Problem with writing backup file ({$backupFile})");

        return $res;
    }

    public function getFile($lang, $name)
    {
        $path = $this->getFilePath($lang, $name);
        return file_exists($path)
            ? include($path)
            : null;
    }

    public function lastModified($fileName)
    {
        $lastModified = [];
        foreach ($this->getLanguages() as $lang) {
            $lastModified[$lang] = $this->lastModifiedForLang($fileName, $lang);
        }
        return $lastModified;
    }

    private function lastModifiedForLang($fileName, $lang)
    {
        if(! in_array($fileName, $this->files))
            return '';

        $path = $this->getFilePath($lang, $fileName);

        if(! file_exists($path))
            return '';

        $timestamp = File::lastModified($path);
        if($timestamp === false)
            return '';

        return Carbon::createFromFormat('U', $timestamp, config('app.timezone'))->toDateTimeString();
    }

    public function getLog()
    {
        $log = [];
        foreach (File::allFiles($this->backupPath()) as $file) {
            $basepath = basename($file->getPathname());

            $name = explode('.', $basepath);
            $time = Carbon::createFromFormat('U', substr($name[1], 4), config('app.timezone'))
                ->toDateTimeString();

            $content = include($file->getPathname());

            $log[] = [
                'name' => $name[0],
                'time' => $time,
                'content' => $content
            ];
        }
        return $log;
    }
}
