<?php

namespace Khepin\DrupalTransliteratorBundle\Listener;

class SluggableListener extends \Gedmo\Sluggable\SluggableListener{

    public function __construct(){
        $this->setTransliterator(array('\Khepin\DrupalTransliteratorBundle\Transliterator', 'sluggableTransliterate'));
    }
}
