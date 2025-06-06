<?php
namespace App\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\JwtService;
use Exception;

class AuthController
{
    protected AuthService $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }    
    public function postLogin(Request $request, Response $response): Response
    {
        try{
        $params = $request->getParsedBody();
        $result = $this->authService->login($params);
        return ResponseHelper::success($response, 'Đăng nhập thành công',$result ,200);
        
    }catch(Exception $e)
    {
        return ResponseHelper::error($response, $e->getMessage(), 404);
    }
    }

    public function postLogout(Request $request, Response $response): Response
    {
        $response->getBody()->write("Logout success!");
        return $response;
    }

}
