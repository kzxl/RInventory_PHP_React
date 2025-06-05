<?php
namespace App\Controllers;

use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    protected AuthService $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function login(Request $request, Response $response): Response
    {
        $params = $request->getParsedBody();
        $email = $params['email'] ?? '';
        $password = $params['password'] ?? '';

        if (!$email || !$password) {
            $response->getBody()->write(json_encode(['error' => 'Email và mật khẩu bắt buộc']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $user = $this->authService->login($email, $password);
        if (!$user) {
            $response->getBody()->write(json_encode(['error' => 'Đăng nhập thất bại']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }

        $response->getBody()->write(json_encode([
            'message' => 'Login success!',
            'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email]
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
