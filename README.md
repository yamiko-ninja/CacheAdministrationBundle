[![Build Status](https://travis-ci.org/yamiko-ninja/CacheAdministrationBundle.svg?branch=master)](https://travis-ci.org/yamiko-ninja/CacheAdministrationBundle)
[![Latest Stable Version](https://poser.pugx.org/yamiko/cache-administration-bundle/v/stable)](https://packagist.org/packages/yamiko/cache-administration-bundle)
[![Total Downloads](https://poser.pugx.org/yamiko/cache-administration-bundle/downloads)](https://packagist.org/packages/yamiko/cache-administration-bundle)
[![Latest Unstable Version](https://poser.pugx.org/yamiko/cache-administration-bundle/v/unstable)](https://packagist.org/packages/yamiko/cache-administration-bundle) [![License](https://poser.pugx.org/yamiko/cache-administration-bundle/license)](https://packagist.org/packages/yamiko/cache-administration-bundle)

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require yamiko/cache-administration-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Yamiko\CacheAdministrationBundle\YamikoCacheAdministrationBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Enable Routes (optional)
------------------------------------

Instead of using the service directly you can map routes to the controller service.
A routing yml file is included for your convenience.

```yml
# app/config/routing.yml
yamiko_cache_administration:
    resource: "@YamikoCacheAdministrationBundle/Resources/config/routing.yml"
```

After deleting the cache the controller will generate a flash message on success or failure.
Then redirect you to the previous page.

*If it can not determine the preivous page it will redirect you to `/` instead*

Services
========

Cache Manager
-------------

```php
// ...

public function someAction()
{
    $cacheManager = $this->get('yamiko_cache_administration.cache_manager');

    // clear annotations cache
    $cacheManager->clearAnnotations();

    // clear assetic cache
    $cacheManager->clearAssetic();

    //clear doctrine cache
    $cacheManager->clearDoctrine();

    // clear translations cache
    $cacheManager->clearTranslations();

    // clear profiles
    $cacheManager->clearProfiles();

    // clear container cache
    $cacheManager->clearContainer();

    //clear routing cache
    $cacheManager->clearRouting();

    // clear class map
    $cacheManager->clearClasses();

    // clear tempaltes
    $cacheManager->clearTemplates();

    // clear everything
    $cacheManager->clearAll();
}

// ...
```

Cache Controller
----------------

The bundle includes a controller with actions to clear the various caches.
To use the controller you can enable the preconfigured routes as described
above or create your own routing file that maps routes to the actions.

*For instructions on enabling the routes included with this bundle read step 3 of the installation instructions*

After deleting the cache the controller will generate a flash message on success or failure.
Then redirect you to the previous page.

*If it can not determine the previous page it will redirect you to `/` instead*

Here is an example route config file mapping routes to all the controller actions.

```yml
# app/config/routing.yml
app_annotation:
    path:     /cache/clear/annotations
    defaults: { _controller: yamiko_cache_administration.controller:annotationsAction }

app_assetic:
    path:     /cache/clear/assetic
    defaults: { _controller: yamiko_cache_administration.controller:asseticAction }

app_doctrine:
    path:     /cache/clear/doctrine
    defaults: { _controller: yamiko_cache_administration.controller:doctrineAction }

app_translations:
    path:     /cache/clear/translations
    defaults: { _controller: yamiko_cache_administration.controller:translationsAction }

app_profiles:
    path:     /cache/clear/profiles
    defaults: { _controller: yamiko_cache_administration.controller:profilesAction }

app_container:
    path:     /cache/clear/container
    defaults: { _controller: yamiko_cache_administration.controller:containerAction }

app_routing:
    path:     /cache/clear/routing
    defaults: { _controller: yamiko_cache_administration.controller:routingAction }

app_classes:
    path:     /cache/clear/classes
    defaults: { _controller: yamiko_cache_administration.controller:classesAction }

app_templates:
    path:     /cache/clear/templates
    defaults: { _controller: yamiko_cache_administration.controller:templatesAction }

app_all:
    path:     /cache/clear/all
    defaults: { _controller: yamiko_cache_administration.controller:allAction }
```

Routes
======

These are the routes included in the bundle if they are enabled.

| name                                      | pattern | description |
| ----------------------------------------- | ------- | ----------- |
yamiko_cache_administration_annotation      | /cache/clear/annotations  | clears annotations cache  |
yamiko_cache_administration_assetic         | /cache/clear/assetic      | clears assetic cache      |
yamiko_cache_administration_doctrine        | /cache/clear/doctrine     | clears doctrine cache     |
yamiko_cache_administration_translations    | /cache/clear/translations | clears translations cache |
yamiko_cache_administration_profiles        | /cache/clear/profiles     | clears profiles cache     |
yamiko_cache_administration_container       | /cache/clear/container    | clears container cache    |
yamiko_cache_administration_routing         | /cache/clear/routing      | clears routing cache      |
yamiko_cache_administration_classes         | /cache/clear/classes      | clears classes cache      |
yamiko_cache_administration_templates       | /cache/clear/templates    | clears templates cache    |
yamiko_cache_administration_all             | /cache/clear/all          | clears all caches         |