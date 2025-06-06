<?php
namespace App\Controllers\Users;

use App\DTO\UserDTO;
use App\Services\Users\UserService;
use App\Helpers\ResponseHelper;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class UserController
{
    protected UserService $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function postFindAll(Request $request, Response $response, array $args): Response{
        $users = $this->userService->findAll();
        if(!$users){
            return ResponseHelper::error($response, 'Không tìm thấy user', 404);
        }
        return ResponseHelper::success($response, 'Lấy user thành công', [
        'user' => $users
        ]);
    }
    public function postFindById(Request $request, Response $response, array $args): Response {
    $params = $request->getParsedBody();
    $user = UserDTO::fromArrayWithMap( $this->userService->findById($params['id']),['full_name'=>'name']);

    if (!$user) {
        return ResponseHelper::error($response, 'Không tìm thấy user', 404);
    }

    return ResponseHelper::success($response, 'Lấy user thành công', [
       'user'=> $user->toPublicArray()
    ]);
}

    public function postCreate (Request $request, Response $response):Response {

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

         return ResponseHelper::success($response, 'Tạo user thành công', [], 201);
    }
    public function postUpdate(Request $request, Response $response, array $args): Response {
    try{
    $id = (int)$args['id'];
    $params = $request->getParsedBody();
    $result = $this->userService->update($id, $params);
    return ResponseHelper::success($response, 'Cập nhật thành công', []);
}catch(Exception $e){
    return ResponseHelper::error($response, $e->getMessage(), 404);
}

}
    public function postDelete(Request $request, Response $response, array $args): Response {
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