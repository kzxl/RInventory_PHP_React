<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class BaseController {
    protected Request $request;
    protected Response $response;
    protected array $args;

    public function __invoke(Request $request, Response $response, array $args): Response {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        // Gọi phương thức handle cụ thể (bắt buộc controller con phải định nghĩa)
        return $this->handle();
    }

    abstract protected function handle(): Response;

    protected function json(array $data, int $status = 200): Response {
        $this->response->getBody()->write(json_encode($data));
        return $this->response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }

    protected function input(): array {
        return (array)$this->request->getParsedBody();
    }

    protected function param(string $key, $default = null) {
        return $this->args[$key] ?? $default;
    }

    protected function query(string $key, $default = null) {
        return $this->request->getQueryParams()[$key] ?? $default;
    }
}
