<?php
namespace App\Services\Users;

use App\DTO\UserDTO as User;
use App\Repositories\UserRepository;
use Exception;

class UserService {
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }
    public function findAll() {
        return $this->userRepo->findAll();
    }
    public function findById(int $id) {
        return $this->userRepo->find($id);
    }
    public function create( $user) {
        return $this->userRepo->create($user);
    }
    public function update(int $id, $params) {
    if (empty($params['full_name']) || !filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Dự liệu không hợp lệ');
    }

    $existing = User::fromArray( $this->findById($id));
    if (!$existing) {
        throw new Exception ('User không tồn tại');
    }
    $updatedUser = array(        
        $params['full_name'],
        $params['email'],
        $params['phone'] ?? $existing->phone,
        $params['password_hash'] ?? $existing->password_hash,
        $params['is_active'] ?? $existing->is_active
    );
        $result = $this->userRepo->update($id, $updatedUser);
        if(!$result)
            throw new Exception('Cập nhật thất bại');
    }
    public function delete(int $id) {
        return $this->userRepo->delete($id);
    }
}