<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use App\Enums\HttpStatus;
use \Exception;

trait ApiResponserTrait
{
    /**
     * Format the response structure.
     * @param array $status
     * @param mixed $response
     * @return JsonResponse
     */
    private function formatResponse($status, $response = null): JsonResponse
    {
        $responseArray['status'] = $status;
        if($response!==null){
            $responseArray['data'] = $response;
        }
        return response()->json($responseArray, $status['code']);
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
