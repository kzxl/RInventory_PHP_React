<?php
namespace App\Services;

use App\DTO\UserDTO;
use App\Repositories\UserRepository;
class AuthService {
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    /**
     * Trả về UserDTO nếu login thành công, hoặc null nếu thất bại
     */
    public function login(string $email, string $password): ?UserDTO {
        $user = $this->userRepo->findByEmail($email);
        if (!$user) return null;
print_r($password);
        if (!password_verify($password, $user->password_hash)) {
            return null;
        }

        return $user;
    }
}
