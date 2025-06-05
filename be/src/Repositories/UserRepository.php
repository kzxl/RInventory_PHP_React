<?php
namespace App\Repositories;

use App\DTO\UserDTO;
use PDO;
class UserRepository {
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail(string $email): ?UserDTO {
        $stmt = $this->pdo->prepare("SELECT id, full_name, email, password_hash FROM tbsys_users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) return null;

        return new UserDTO($row['id'], $row['full_name'], $row['email'], $row['password_hash']);
    }
}
