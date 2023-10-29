<?php

declare(strict_types=1);

namespace App\Router;

use Nette\StaticClass;
use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    use StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList();
        $router->addRoute('/', 'Employee:index');
        $router->addRoute('/chart', 'Employee:chart');
        $router->addRoute('/new', 'Employee:add');
        $router->addRoute('/edit/<id>', 'Employee:edit');
        $router->addRoute('/delete/<id>', 'Employee:delete');
        return $router;
    }
}
