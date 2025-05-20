<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use App\Enums\HttpStatus;

trait ApiResponserTrait
{
    /**
     * Format the response structure.
     *
     * @param array $status
     * @param array $response
     * @return JsonResponse
     */
    private function formatResponse(array $status, object | array $response): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $response,
        ], $status['code']);
    }

    /**
     * Dynamically get the model name from the given data.
     *
     * @param Model $data
     * @return string
     */
    private function getModelName(Model $data): string
    {
        return class_basename($data);
    }

    /**
     * Return a JSON response for a Single Data.
     *
     * @param Model $data
     * @param HttpStatus $status
     * @return JsonResponse
     */
    protected function singleModelResponse(Model $data, HttpStatus $status = HttpStatus::OK, string $customMessage = null): JsonResponse
    {

        return $this->formatResponse(
            [
                'code' => $status->value,
                'name' => $status->name,
                'message' => $customMessage ?? $status->message(),
            ],
            $data,
        );
    }

    /**
     * Return a JSON response for a List of Data.
     *
     * @param LengthAwarePaginator $list
     * @param HttpStatus $status
     * @return JsonResponse
     */

    protected function listDataResponse(LengthAwarePaginator $list, HttpStatus $status = HttpStatus::OK, string $customMessage = null): JsonResponse
    {
        return $this->formatResponse(
            [
                'code' => $status->value,
                'name' => $status->name,
                'message' => $customMessage ?? $status->message(),
            ],
            $list,
        );
    }
}
