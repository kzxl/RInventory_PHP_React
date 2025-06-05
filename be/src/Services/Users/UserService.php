<?php
namespace App\Services\Users;

use App\DTO\UserDTO as User;
use App\Repositories\UserRepository;
class UserService {
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }
    public function findAll() {
        return $this->userRepo->findAll();
    }
    public function findById(int $id) {
        return $this->userRepo->findById($id);
    }
    public function create(User $user) {
        return $this->userRepo->create($user);
    }
    public function update(User $user) {
        return $this->userRepo->update($user);
    }
    public function delete(int $id) {
        return $this->userRepo->delete($id);
    }
}