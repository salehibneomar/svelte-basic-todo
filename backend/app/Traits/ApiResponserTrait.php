<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use App\Enums\HttpStatus;
use \Exception;

trait ApiResponserTrait
{
    private function formatResponse($status, $response = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $response,
        ], $status['code']);
    }

    private function getModelName(Model $data): string
    {
        return class_basename($data);
    }

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

    protected function listDataResponse(LengthAwarePaginator $list, HttpStatus $status = HttpStatus::OK): JsonResponse
    {
        return $this->formatResponse(
            [
                'code' => $status->value,
                'name' => $status->name,
            ],
            $list,
        );
    }

    protected function errorResponse(Exception $e, HttpStatus $status = HttpStatus::INTERNAL_SERVER_ERROR, $customMessage = null): JsonResponse
    {
        return response()->json([
            'status' => [
                'code' => $status->value,
                'name' => $status->name,
                'message' => $customMessage ?? $e->getMessage(),
                'trace' => basename($e->getFile()) . ': ' . $e->getLine()
            ],
        ], $status->value);
    }
}
