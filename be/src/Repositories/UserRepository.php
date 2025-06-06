<?php
namespace App\Repositories;

use App\DTO\UserDTO;
use Exception;
use PDO;
class UserRepository extends BaseRepository {
    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
        $this->table = 'tbsys_users';
        $this->fields = ['full_name', 'email', 'phone', 'password_hash', 'is_active'];
    }

    public function findByEmail(string $email): ?array {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email không hợp lệ");
    }
        $stmt = $this->pdo->prepare("SELECT * FROM tbsys_users WHERE email = ?");
        $stmt->execute([$email]);
       return $stmt->fetch()?:null;
    }
}
