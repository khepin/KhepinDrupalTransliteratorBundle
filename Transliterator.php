<?php

namespace Khepin\DrupalTransliteratorBundle;

use Gedmo\Sluggable\Util\Urlizer;

/**
 * Utility class to transliterate non alphabetic characters to their romanized
 * form if they have one.
 */
class Transliterator {

    /**
     * Tansliterates non alphabetic characters
     * @param string $text
     * @return string
     * @throws Exception
     */
    public static function transliterate($text) {
        if (!function_exists('_transliteration_process')) {
            require_once __DIR__ . '/vendor/drupal/transliteration/transliteration.inc';
        }

        return _transliteration_process($text);
    }

    /**
     * Method to be compatible with the declaration in Doctrine extensions
     * @param type $text
     * @param type $separator
     * @param type $object
     * @return type
     */
    public static function sluggableTransliterate($text, $separator, $object){
        return Urlizer::urlize(self::transliterate($text), $separator);
    }
}