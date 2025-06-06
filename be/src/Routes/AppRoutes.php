
<?php
use Slim\App;
use App\Controllers\Auth\AuthController;
use App\Controllers\Users\UserController;
use App\Controllers\Customer\CustomerController;

return function (App $app) {
    $app->group('/api', function ($group) {
        $group->post('/login', [AuthController::class, 'postLogin']);
        $group->post('/logout', [AuthController::class, 'postLogout']);
       
    });
    $app->group('/api/user', function ($group) {
        $group->post('/findall', [UserController::class, 'findAll']);        
        $group->post('/find', [UserController::class, 'find']);
        $group->post('/create', [UserController::class, 'create']);
        $group->post('/update/{id}', [UserController::class, 'update']);
        $group->post('/delete', [UserController::class, 'delete']);
       
    });
    $app->group('/api/customer',function($group){
        $group->post('/findall', [CustomerController::class, 'findAll']);        
        $group->post('/find/{id}', [CustomerController::class, 'find']);
        $group->post('/create', [CustomerController::class, 'create']);
        $group->post('/update/{id}', [CustomerController::class, 'update']);
        $group->post('/delete/{id}', [CustomerController::class, 'delete']);
    });
    $app->get('/', function ($request, $response) {
    $response->getBody()->write("Slim is working!");
    return $response;
});

};