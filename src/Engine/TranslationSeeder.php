<?php

namespace JanDolata\TranslationsEditor\Engine;

use Illuminate\Database\Seeder;
use JanDolata\TranslationsEditor\Engine\Translation;

/**
 * Translation seeder
 * @author Jan Dolata <j.dolata@holonglobe.com>
 */
class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translation = new Translation;

        $all = $translation->getAll('all');

        $trans = [];
        foreach ($translation->getLanguages() as $lang) {
            $trans[$lang] = [];

            foreach ($all as $item)
                $trans[$lang][$item->key] = $item->trans[$lang];
        }

        $translation->saveForm($trans);
    }
}
