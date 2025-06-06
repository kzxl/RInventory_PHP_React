<?php
namespace App\Services;

use App\DTO\UserDTO;
use App\Repositories\UserRepository;
use Exception;

class AuthService {
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    /**
     * Trả về UserDTO nếu login thành công, hoặc null nếu thất bại
     */
    public function login($params): ?array {
        $jwtService = new JwtService();
        $email = $params['email'];
        $password = $params['password'];

        if (!$email || !$password) {
            throw new Exception('Email và mật khẩu phải có');
        }


        $user = UserDTO::fromArray($this->userRepo->findByEmail($email));
        if (!$user||$user->password_hash!= $password) throw new Exception('Email hoặc mật khẩu không đúng');
        
        $token = $jwtService->generateToken([
            'uid' => $user->id,
            'email' => $user->email,
            'password'=>$user->password_hash
        ]);

        return ['user'=>$user->toFilteredArray(['password_hash']),'token'=>$token];
        
        
    }
}
