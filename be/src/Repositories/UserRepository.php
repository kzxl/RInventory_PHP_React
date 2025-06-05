<?php
namespace App\Repositories;

use App\DTO\UserDTO;
use Exception;
use PDO;
use function PHPUnit\Framework\returnArgument;
class UserRepository {
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function findById(int $id): ?UserDTO {
    if ($id <= 0) return null;

    $stmt = $this->pdo->prepare("SELECT id, full_name, email, phone, password_hash, is_active FROM tbsys_users WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) return null;

    return new UserDTO($row['id'], $row['full_name'], $row['email'], $row['phone'], $row['password_hash'], $row['is_active']);
}

    public function findByEmail(string $email): ?UserDTO {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email không hợp lệ");
    }
        $stmt = $this->pdo->prepare("SELECT id, full_name, email, phone, password_hash, is_active FROM tbsys_users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) return null;

        return new UserDTO($row['id'], $row['full_name'], $row['email'], $row['phone'], $row['password_hash'], $row['is_active']);
    }
    public function findAll(): ?array {
    $stmt = $this->pdo->prepare('SELECT id, full_name, email, phone, password_hash, is_active FROM tbsys_users');
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        return null; // hoặc return [];
    }

    $users = [];
    foreach ($rows as $row) {
        $users[] = new UserDTO(
            $row['id'],
            $row['full_name'],
            $row['email'],
            $row['phone'],
            $row['password_hash'],
            $row['is_active']
        );
    }

    return $users;
}

    public function create(UserDTO $entity): ?UserDTO {
        $stmt = $this->pdo->prepare("INSERT INTO tbsys_users (full_name, email, phone, password_hash, is_active) VALUES (?, ?, ?, ?, ?)");
        $success = $stmt->execute([
            $entity->name,
            $entity->email,
            $entity->phone,
            $entity->password_hash,
            $entity->is_active
        ]);

        if (!$success) return null;

        // Lấy id mới tạo
        $id = (int)$this->pdo->lastInsertId();

        // Trả về UserDTO mới có id
        return new UserDTO(
            $id,
            $entity->name,
            $entity->email,
            $entity->phone,
            $entity->password_hash,
            $entity->is_active
        );
    }

    public function update(UserDTO $entity): bool {
        $stmt = $this->pdo->prepare("UPDATE tbsys_users SET full_name = ?, email = ?, phone = ?, password_hash = ?, is_active = ? WHERE id = ?");
        return $stmt->execute([
            $entity->name,
            $entity->email,
            $entity->phone,
            $entity->password_hash,
            $entity->is_active,
            $entity->id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM tbsys_users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
