<?php
namespace App\Helpers;

use slim\Psr7\Response;
class ResponseHelper {
    public static function json(Response $response, array $data, int $statusCode = 200): Response {
        $response->getBody()->write(json_encode($data));
        return $response->withStatus($statusCode)->withHeader('Content-Type', 'application/json');
    }

    public static function success(Response $response, string $message, array $data = [], int $statusCode = 200): Response {
    $data = self::normalizeData($data);

    return self::json($response, [
        'success' => true,
        'message' => $message,
        'data'    => $data
    ], $statusCode);
    }


    public static function error(Response $response, string $message, int $statusCode = 400): Response {
        return self::json($response, [
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
    private static function normalizeData($data) {
    if (is_array($data)) {
        return array_map([self::class, 'normalizeData'], $data);
    }

    if (is_object($data) && method_exists($data, 'toArrayFiltered')) {
        return $data->toArrayFiltered();
    }

    return $data;
}

}
