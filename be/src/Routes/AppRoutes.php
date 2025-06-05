
<?php
use Slim\App;
use App\Controllers\AuthController;

return function (App $app) {
    $app->group('/api', function ($group) {
        $group->post('/login', [AuthController::class, 'login']);
        $group->post('/logout', [AuthController::class, 'logout']);
       
    });
    
    $app->get('/', function ($request, $response) {
    $response->getBody()->write("Slim is working!");
    return $response;
});

};