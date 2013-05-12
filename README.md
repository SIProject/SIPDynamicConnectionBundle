Dynamic enable bundles
======================

Allows you to enable/disable bundles via the command line

Installation
============

1. command to add the bundle to your composer.json and download package.
------------------------------------------------------------------------

``` bash
$ composer require "sip/dynamic-connection-bundle": "dev-master"
```

2. Configuration:
-----------------

``` yml
# app/config/config.yml
sip_dynamic_connection:
    # All Default configuration:
    # app_kernel_path: /AppKernelDynamic.php
    # config_path: /config/resources/dynamic.yml
    # routing_path: /config/routing_dynamic.yml
```

3. Include config file for dynamic configuration
------------------------------------------------

``` yml
# app/config/config.yml
imports:
    - { resource: resources/dynamic.yml }
```

4. Include routing file for dynamic routing
-------------------------------------------

``` yml
# app/config/routing.yml
_dynamic:
    resource: routing_dynamic.yml
```

4. Add files to configure and enable the plug-bundles
-----------------------------------------------------

``` bash
$ touch app/AppKernelDynamic.php
$ touch app/config/resources/dynamic.yml
$ touch app/config/routing_dynamic.yml
```

5. Enable the bundle inside the kernel.
---------------------------------------

``` php
<?php

// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        new SIP\DynamicConnectionBundle\SIPDynamicConnectionBundle()
        // If you wish to use SonataAdmin
        new Sonata\BlockBundle\SonataBlockBundle(),
        new Sonata\jQueryBundle\SonatajQueryBundle(),
        new Sonata\AdminBundle\SonataAdminBundle(),

        // Other bundles...
    );

    include "AppKernelDynamic.php";
}
```

[Read more about installation SonataAdminBundle](http://sonata-project.org/bundles/admin/master/doc/reference/installation.html#installation)

6. Bundle settings in SonataAdmin backend:
------------------------------------------

[![bundle_settings](/SIProject/SIPDynamicConnectionBundle/tree/master/Resources/doc/bundle_settings.png)]