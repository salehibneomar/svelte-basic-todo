<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'completed'];
}
