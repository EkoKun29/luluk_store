<?php

use Illuminate\Http\JsonResponse;

class JsonFormatter{
    public static function paginateFormat(array $data, int $size, int $total, int $totalPages, int $current): JsonResponse
    {
        return response()->json((object)[
            'code' => 200,
            'status' => 'OK',
            'data' => $data,
            'page' => (object)[
                'size' => $size,
                'total' => $total,
                'totalPages' => $totalPages,
                'current' => $current
            ]
        ]);
    }

    public static function successFormat(array $data): JsonResponse
    {
        return response()->json((object)[
            'code' => 200,
            'status' => 'OK',
            'data' => $data
        ]);
    }

    public static function errorFormat(int $code, string $status, array $errors): JsonResponse
    {
        return response()->json((object)[
            'code' => $code,
            'status' => $status,
            'errors' => $errors
        ]);
    }
}
