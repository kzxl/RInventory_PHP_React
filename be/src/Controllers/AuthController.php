<?php
namespace App\Controllers;

use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\JwtService;
class AuthController
{
    protected AuthService $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function login(Request $request, Response $response): Response
    {
        $jwtService = new JwtService();
        $params = $request->getParsedBody();
        $email = $params['email'] ?? '';
        $password = $params['password'] ?? '';

        if (!$email || !$password) {
            $response->getBody()->write(json_encode(['success'=>false,'error' => 'Email và mật khẩu bắt buộc']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $user = $this->authService->login($email, $password);
        if (!$user) {
            $response->getBody()->write(json_encode(['success'=>false, 'error' => 'Email hoặc mật khẩu không đúng']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }
        $token = $jwtService->generateToken([
            'uid' => 123,
            'email' => 'user@example.com'
        ]);
        $response->getBody()->write(json_encode([
            'success'=> true,
            'message' => 'Login success!',
            'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
            'token'=> $token
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function logout(Request $request, Response $response): Response
    {
        $response->getBody()->write("Logout success!");
        return $response;
    }

    public function hello(Request $request, Response $response): Response
    {
        $response->getBody()->write("Hello from Slim!");
        return $response;
    }
}
