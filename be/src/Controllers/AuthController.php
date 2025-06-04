<?php
namespace App\Controllers;
use App\DTO\LoginRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController {
    public function login(Request $request, Response $response): Response {
        $params = json_decode($request->getBody()->getContents(), true);
        $loginDto =new LoginRequest(($params));
        if(!$loginDto->isValid())
        {
            $errors = $loginDto->getErrors();
            $response->getBody()->write(json_encode(['errors' => $params]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
        // Xử lý đăng nhập ở đây, ví dụ:
        // $user = $this->authService->login($loginDto->email, $loginDto->password);

        $data = ['message' => 'Đăng nhập thành công '.$loginDto->email];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function logout(Request $request, Response $response): Response {
        // Xử lý logout
        $data = ['message' => 'Đăng xuất thành công'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
