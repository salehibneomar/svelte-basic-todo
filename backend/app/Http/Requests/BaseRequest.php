<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiResponserTrait;
use Illuminate\Contracts\Validation\Validator;
use App\Enums\HttpStatus;
use Illuminate\Validation\ValidationException;

/**
 * This class extends Laravel's FormRequest and provides a centralized way to handle validation failures.
 */
class BaseRequest extends FormRequest
{
    use ApiResponserTrait;

    /**
     * @override the 'failedValidation' the default method of FormRequest
     * @param Validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $exception = new \Exception('Validation Failed');
        $response = $this->errorResponse($exception, HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}
