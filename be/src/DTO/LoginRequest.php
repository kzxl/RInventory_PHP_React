<?php
namespace App\DTO;

class LoginRequest {
    public string $email;
    public string $password;

    public function __construct(array $data) {
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    public function isValid(): bool {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) && !empty($this->password);
    }

    public function getErrors(): array {
        $errors = [];
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ.';
        }
        if (empty($this->password)) {
            $errors[] = 'Password không được để trống.';
        }
        return $errors;
    }
}
