<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController {
    public function login(Request $request, Response $response): Response {
        $params = (array)$request->getParsedBody();
        // Xử lý login ở đây
        $data = ['message' => 'Đăng nhập thành công'];
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
