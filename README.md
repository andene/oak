
## Oak Hack Framework for HHVM ##


This framework is built for myself to try out some of the new fetures in [Hack](http://hacklang.org)


## Routes

Routes is managed in "bootstrap/routes.php"

```php
// bootstrap/routes.php

<?hh
use \Oak\Route\Route;
use \Oak\Route\Routes;

$routes = new Routes();

$routes->addRoute(new Route('/', 'index', 'index'));
$routes->addRoute(new Route('info/{param}', 'index', 'about'));

Container::set('routes', $routes);

```
