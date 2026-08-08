<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponse
{
    public static function success(string $ref, string $msg, mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'result' => ['code' => $code, 'ref' => $ref, 'msg' => $msg],
            'data' => $data,
        ], $code);
    }

    public static function error(string $ref, string $msg, int $code = 400, mixed $data = null): JsonResponse
    {
        return response()->json([
            'result' => ['code' => $code, 'ref' => $ref, 'msg' => $msg],
            'data' => $data,
        ], $code);
    }

    /**
     * Build the standard `{ items, meta }` listing payload used by every
     * paginated endpoint in the API contract.
     */
    public static function paginated(string $ref, string $msg, LengthAwarePaginator $paginator, ?callable $mapItem = null): JsonResponse
    {
        $items = $paginator->getCollection();

        if ($mapItem !== null) {
            $items = $items->map($mapItem);
        }

        return self::success($ref, $msg, [
            'items' => $items->values(),
            'meta' => [
                'page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'total_pages' => $paginator->lastPage(),
            ],
        ]);
    }
}
