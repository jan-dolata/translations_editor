<?php

namespace JanDolata\TranslationsEditor\Engine;

/**
 * Translation model
 * @author Jan Dolata <j.dolata@holonglobe.com>
 */
class TranslationModel
{
    public $key      = null;
    public $base     = null;
    public $trans    = [];

    function __construct($data = [])
    {
        $this->key      = $data['key'];
        $this->base     = $data['base'];
        $this->trans    = $data['trans'];
    }
}
