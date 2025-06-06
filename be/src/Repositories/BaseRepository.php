<?php
namespace App\Repositories;

use PDO;
abstract class BaseRepository {
    protected PDO $pdo;
    protected string $table;
    protected array $fields;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find($id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
    public function create(array $params): bool {
        
            $columns = implode(', ', $this->fields);
            $placeholders = implode(', ', array_fill(0, count($this->fields), '?'));
            $values = array_map(fn($field) => $params[$field] ?? null, $this->fields);

            $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
            return $stmt->execute($values);
        
    }

    public function update(int $id, array $params): bool {
        
            $set = implode(', ', array_map(fn($field) => "$field = ?", $this->fields));
            $values = array_map(fn($field) => $params[$field] ?? null, $this->fields);
            $values[] = $id;

            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET {$set} WHERE id = ?");
            return $stmt->execute($values);
        
    }
    public function delete($id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
