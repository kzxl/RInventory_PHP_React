
<?php
use Slim\App;
use App\Controllers\AuthController;
use App\Controllers\Users\UserController;

return function (App $app) {
    $app->group('/api', function ($group) {
        $group->post('/login', [AuthController::class, 'login']);
        $group->post('/logout', [AuthController::class, 'logout']);
       
    });
    $app->group('/api/user', function ($group) {
        $group->post('/getall', [UserController::class, 'findAll']);        
        $group->post('/getwithid', [UserController::class, 'findById']);
        $group->post('/create', [UserController::class, 'create']);
        $group->post('/update', [UserController::class, 'update']);
        $group->post('/delete', [UserController::class, 'delete']);
       
    });
    $app->get('/', function ($request, $response) {
    $response->getBody()->write("Slim is working!");
    return $response;
});

};