# KISS
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8f4a896e-14f4-4502-920d-b61d02273b54/big.png)](https://insight.sensiolabs.com/projects/8f4a896e-14f4-4502-920d-b61d02273b54)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/plispe/kiss/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/plispe/kiss/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/plispe/kiss/badges/build.png?b=master)](https://scrutinizer-ci.com/g/plispe/kiss/build-status/master)

### The most innovative PHP devstack standing on the shoulder of giants

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)
<a href="https://my.scalingo.com/deploy?source=https://github.com/plispe/kiss">
   <img src="https://cdn.scalingo.com/deploy/button.svg" alt="Deploy on Scalingo" data-canonical-src="https://cdn.scalingo.com/deploy/button.svg" style="max-width:100%; width="147" height="32">
</a>

## Under the hood

- The [PHP-DI](http://php-di.org/index.html) container is used, but every [container-interop](https://github.com/container-interop/container-interop) container can be used or with [Acclimate](https://github.com/jeremeamia/acclimate-container) you can use [several containers at once](http://php-di.org/doc/container-configuration.html#using-php-di-with-other-containers).

- [zend-diactoros](https://github.com/zendframework/zend-diactoros), [Aura.Router](http://auraphp.com/packages/Aura.Router/), [Relay](http://relayphp.com/), [psr7-middlewares](https://github.com/oscarotero/psr7-middlewares)
- For Sql databases [Pomm](http://www.pomm-project.org/) is favored, but [Dibi](http://dibiphp.com/) and [Spot2](http://phpdatamapper.com/) factories are provided.
- [Carbon](http://carbon.nesbot.com/), [Stringy](https://github.com/danielstjules/Stringy), [Underscore.php](http://anahkiasen.github.io/underscore-php/)
- [Error-handler](https://github.com/mrjgreen/error), [Tracy](http://tracy.nette.org/en/)
- [Robo](http://robo.li/)
- [Bernard](https://bernard.readthedocs.org/)
