<?php
namespace App\Controllers\Users;

use App\DTO\UserDTO;
use App\Services\Users\UserService;
use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class UserController
{
    protected UserService $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function findAll(Request $request, Response $response, array $args): Response{
        $users = $this->userService->findAll();
        if(!$users){
            return ResponseHelper::error($response, 'Không tìm thấy user', 404);
        }
        return ResponseHelper::success($response, 'Lấy user thành công', [
        'users'=> $users
        ]);
    }
    public function findById(Request $request, Response $response, array $args): Response {
    $id = (int)$args['id'];
    $user = $this->userService->findById($id);

    if (!$user) {
        return ResponseHelper::error($response, 'Không tìm thấy user', 404);
    }

    return ResponseHelper::success($response, 'Lấy user thành công', [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email
    ]);
}

    public function create (Request $request, Response $response):Response {

        $params = $request->getParsedBody();
        // Validate đơn giản
    if (empty($params['full_name']) || !filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
        return ResponseHelper::error($response, 'Dữ liệu không hợp lệ');
    }
        $item = new UserDTO(
        null,
        $params['full_name'],
        $params['email'],
        $params['phone'],
        $params['password_hash'],
        $params['is_active'] ?? 1
    );
        $newUser = $this->userService->create($item);
    if (!$newUser) {
        return ResponseHelper::error($response, 'Tạo user thất bại', 500);
    }

         return ResponseHelper::success($response, 'Tạo user thành công', [
        'id' => $newUser->id,
        'name' => $newUser->name,
        'email' => $newUser->email
    ], 201);
    }
    public function update(Request $request, Response $response, array $args): Response {
    $id = (int) $args['id'];
    $params = $request->getParsedBody();

    if (empty($params['full_name']) || !filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
        return ResponseHelper::error($response, 'Dữ liệu không hợp lệ');
    }

    $existing = $this->userService->findById($id);
    if (!$existing) {
        return ResponseHelper::error($response, 'User không tồn tại', 404);
    }

    $updatedUser = new UserDTO(
        $id,
        $params['full_name'],
        $params['email'],
        $params['phone'],
        $params['password_hash'] ?? $existing->password_hash,
        $params['is_active'] ?? $existing->is_active
    );

    $result = $this->userService->update($updatedUser);
    if (!$result) {
        return ResponseHelper::error($response, 'Cập nhật thất bại', 500);
    }

    return ResponseHelper::success($response, 'Cập nhật thành công', [
        'id' => $updatedUser->id,
        'name' => $updatedUser->name,
        'email' => $updatedUser->email
    ]);
}
    public function delete(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];

        $user = $this->userService->findById($id);
        if (!$user) {
            return ResponseHelper::error($response, 'User không tồn tại', 404);
        }

        $deleted = $this->userService->delete($id);
        if (!$deleted) {
            return ResponseHelper::error($response, 'Xóa user thất bại', 500);
        }

        return ResponseHelper::success($response, 'Xóa user thành công');
    }

}