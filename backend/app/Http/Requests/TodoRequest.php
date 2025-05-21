<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiResponserTrait;
use Illuminate\Contracts\Validation\Validator;
use App\Enums\HttpStatus;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\BaseRequest;

class TodoRequest extends BaseRequest
{
    use ApiResponserTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //TODO: need to implement this when we have AUTH
        // For now, we will allow all requests
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $titleCommonRule = 'string|min:3|max:255';
        $titleRule = request()->isMethod('PATCH') ? 'sometimes|'.$titleCommonRule : 'required|'.$titleCommonRule;
        return [
            'title' =>  $titleRule,
            'description' => 'nullable|string',
            'is_completed' => 'nullable|boolean',
        ];
    }
}
