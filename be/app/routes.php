<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {    
    $app->options('/{routes:.+}', function ($request, $response) {
        return $response;
    });
    (require dirname(__DIR__) . '/src/Routes/AppRoutes.php')($app);
    
    $app->get('/ping', function ($request, $response) {
    $response->getBody()->write('pong');
    return $response;
    });

    

};
