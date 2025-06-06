<?php
namespace App\Services;

use App\Repositories\BaseRepository;

abstract class BaseService {
    protected BaseRepository $repo;

    public function __construct(BaseRepository $repo) {
        $this->repo = $repo;
    }

    public function findAll(): array {
        return $this->repo->findAll();
    }

    public function find(int $id): ?array {
        return $this->repo->find($id);
    }

    public function create(array $data): bool {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data): bool {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool {
        return $this->repo->delete($id);
    }
}
