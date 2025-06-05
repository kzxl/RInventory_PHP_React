<?php
namespace App\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class JwtService
{
    private string $secretKey = 'your_supper_strong_secret_key';
    private string $algorithm = 'HS256';
    private int $tokenTTL = 3600; // 1 giờ

    public function generateToken(array $payload): string
    {
        $issuedAt = time();
        $payload = array_merge([
            'iat' => $issuedAt,
            'exp' => $issuedAt + $this->tokenTTL
        ], $payload);

        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    public function validateToken(string $token): object|false
    {
        try {
            return JWT::decode($token, new Key($this->secretKey, $this->algorithm));
        } catch (ExpiredException $e) {
            error_log("JWT expired: " . $e->getMessage());
        } catch (Exception $e) {
            error_log("JWT invalid: " . $e->getMessage());
        }

        return false;
    }
}
