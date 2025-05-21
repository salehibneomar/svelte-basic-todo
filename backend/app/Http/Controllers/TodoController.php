<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponserTrait;
use App\Services\TodoService;
use \Exception;
use App\Enums\HttpStatus;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    use ApiResponserTrait;

    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $todos = $this->todoService->getAllTodos($request);
            return $this->listDataResponse($todos);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified Todo resource.
     *
     * @param int $id The ID of the Todo resource.
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id): JsonResponse
    {
        try {
            $todo = $this->todoService->getTodoById($id);
            return $this->singleModelResponse($todo);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $todo = $this->todoService->deleteTodoById($id);
            return $this->singleModelResponse($todo, HttpStatus::NO_CONTENT);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
    }

}
