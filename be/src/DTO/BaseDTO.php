<?php
namespace App\DTO;

use JsonSerializable;

abstract class BaseDTO implements JsonSerializable
{
    // Field nào cần ẩn khi gọi toFilteredArray hoặc toPublicArray
    protected array $hiddenFields = [];
    public function jsonSerialize(): array {
        $result = [];

        foreach (get_object_vars($this) as $key => $value) {
            if (!in_array($key, $this->hiddenFields)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    public function toArray(): array {
        return get_object_vars($this);
    }

    public function toFilteredArray(array $excludeFields = []): array {
        $data = $this->toArray();

        foreach ($excludeFields as $field) {
            unset($data[$field]);
        }

        return $data;
    }

    public function toArrayFiltered(): array {
        $result = [];

        foreach (get_object_vars($this) as $key => $value) {
            if (!in_array($key, $this->hiddenFields)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
    // Tự động lọc theo $hiddenFields của class con
    public function toPublicArray(): array {
        return $this->toFilteredArray($this->hiddenFields);
    }

    // Auto mapping từ array
    public static function fromArray(array $data): static {
    $dto = new static();
    foreach ($data as $key => $value) {
        if (property_exists($dto, $key)) {
            $dto->$key = $value;
        }
    }
    return $dto;
}


    // Mapping có ánh xạ key => property
    public static function fromArrayWithMap(array $data, array $map): static {
        foreach ($map as $from => $to) {
            if (isset($data[$from])) {
                $data[$to] = $data[$from];
                unset($data[$from]);
            }
        }
        return static::fromArray($data);
    }
}
