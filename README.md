TmsSupervisionBundle
====================

Installation
------------

Add dependencies in your `composer.json` file:
```json
"repositories": [
    ...,
    {
        "type": "vcs",
        "url": "https://github.com/Tessi-Tms/TmsSupervisionBundle.git"
    }
],
"require": {
    ...,
    "tms/supervision-bundle": "1.0.*"
},    
```

Install this new dependencie in your application using composer:
```sh
$ php composer.phar update
```

Register needed bundles in your application kernel:
```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Tms\Bundle\SupervisionBundle\TmsSupervisionBundle(),
    );
}
```

Documentation
-------------

* [Introduction](Resources/doc/introduction.md)
* [Commands](Resources/doc/commands.md)
* [Usage](Resources/doc/check.md)
