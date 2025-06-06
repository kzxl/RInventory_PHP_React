<?php
namespace App\Controllers;

use App\Services\BaseService;
use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class BaseResourceController {
    protected BaseService $service;

    public function __construct(BaseService $service) {
        $this->service = $service;
    }

    public function findAll(Request $request, Response $response, array $args): Response {
        $data = $this->service->findAll();
        return ResponseHelper::success($response, 'Lấy danh sách thành công', $data);
    }

    public function find(Request $request, Response $response, array $args): Response {
        $id = $args['id'] ?? null;
        $item = $this->service->find((int)$id);

        if (!$item)
            return ResponseHelper::error($response, 'Không tìm thấy', 404);

        return ResponseHelper::success($response, 'Lấy dữ liệu thành công', $item);
    }

    public function create(Request $request, Response $response, array $args): Response {
        $input = (array)$request->getParsedBody();
        $ok = $this->service->create($input);

        if (!$ok)
            return ResponseHelper::error($response, 'Tạo thất bại');

        return ResponseHelper::success($response, 'Tạo thành công', [], 201);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $id = (int)($args['id'] ?? 0);
        $input = (array)$request->getParsedBody();
        $ok = $this->service->update($id, $input);

        if (!$ok)
            return ResponseHelper::error($response, 'Cập nhật thất bại');

        return ResponseHelper::success($response, 'Cập nhật thành công');
    }

    public function delete(Request $request, Response $response, array $args): Response {
        $id = (int)($args['id'] ?? 0);
        $ok = $this->service->delete($id);

        if (!$ok)
            return ResponseHelper::error($response, 'Xóa thất bại');

        return ResponseHelper::success($response, 'Xóa thành công');
    }
}
