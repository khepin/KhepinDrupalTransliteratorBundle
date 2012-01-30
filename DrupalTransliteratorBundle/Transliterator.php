<?php

namespace Khepin\DrupalTransliteratorBundle;

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
     * Transliterates non alphabetic characters then returns a url friendly
     * version of the text with whitespaces replaced by $separator
     * 
     * @param type $text
     * @param type $separator
     * @param type $object
     * @return type
     * @throws Exception 
     */
    public static function transliterateAndUrlize($text, $separator, $object) {
        $text = self::transliterate($text);
        if (!class_exists('\Gedmo\Sluggable\Util\Urlizer')) {
            throw new Exception('KhepinDrupalTransliteratorBundle requires Gedmo' .
                    ' Doctrine extensions in order to work. We could not find the class' .
                    ' \Gedmo\Sluggable\Util\Urlizer');
        }
        return \Gedmo\Sluggable\Util\Urlizer::urlize($text, $separator);
    }

}