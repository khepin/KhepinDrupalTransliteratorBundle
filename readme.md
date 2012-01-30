This bundle provides a better transliterator than the one included in Doctrine
Extensions. This is useful for the `Sluggable` behavior if you are using a non
alphabetic based language. The one bundled in Doctrine extensions works fine
for many languages but I found limitations with Chinese at least. Drupal provides
a more advanced one.

Transliteration is the process of changing text from `北京` to `Bei Jing`. So that
it can be url formatted afterwards.

# Installation

Through the deps files add:

    [KhepinDrupalTransliteratorBundle]
        git=https://github.com/khepin/KhepinDrupalTransliteratorBundle.git
        target=/bundles/Khepin

Run your vendor script `./bin/vendors install`.

In your `autoload.php` register the Khepin namespace:

    $loader->registerNamespaces(array(
        // ...
        'Khepin'           => __DIR__.'/../vendor/bundles',
        // ...
    ));

Then register the bundle in `AppKernel.php`:

    public function registerBundles()
    {
        $bundles = array(
            //...
            new Khepin\DrupalTransliteratorBundle\KhepinDrupalTransliteratorBundle(),
            // ...
        );
        //...
    }

# Usage

The bundle provides a Transliterator class with two methods:
- One to just transliterate the text: `Khepin\DrupalTransliteratorBundle\Transliterator::transliterate`
- One that is compatible directly with the declaration in doctrine extensions `Khepin\DrupalTransliteratorBundle\Transliterator::sluggableTransliterate`

The bundle also overrides the standard Doctrine Extensions Sluggable listener so that
it uses this transliteration method rather than the standard one. In order to use
it, change your DoctrineExtensionBundle to use the new listener:

    stof_doctrine_extensions:
        class:
            sluggable: Khepin\DrupalTransliteratorBundle\Listener\SluggableListener
        mongodb:
            default: 
                sluggable: true
        # or
        orm:
            default:
                sluggable: true