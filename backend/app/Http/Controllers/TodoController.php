<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TodoService;
use \Exception;
use App\Traits\ApiResponserTrait;
use App\Enums\HttpStatus;
use App\Enums\CrudStatus;
use App\Http\Requests\TodoRequest;

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

    public function show($id): JsonResponse
    {
        try {
            $todo = $this->todoService->getTodoById($id);
            return $this->singleModelResponse($todo);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
    }

    public function store(TodoRequest $request) : JsonResponse {
        try {
            $todo = $this->todoService->createTodo($request->validated());
            return $this->singleModelResponse($todo, HttpStatus::CREATED, CrudStatus::CREATED->value);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function update(TodoRequest $request, $id): JsonResponse
    {
        try {
            $todo = $this->todoService->updateTodoById($id, $request->validated());
            return $this->singleModelResponse($todo, HttpStatus::OK, CrudStatus::UPDATED->value);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $todo = $this->todoService->deleteTodoById($id);
            return $this->singleModelResponse($todo, HttpStatus::OK, CrudStatus::DELETED->value);
        } catch (Exception $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
    }

}
