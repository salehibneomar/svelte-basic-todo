<?php

namespace App\Services;

use App\Models\Todo;

class TodoService
{
    public function getTodoById (int $id) : Todo {
        return Todo::findOrFail($id);
    }
}
