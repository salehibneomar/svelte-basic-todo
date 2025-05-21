<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiResponserTrait;
use Illuminate\Contracts\Validation\Validator;
use App\Enums\HttpStatus;
use Illuminate\Validation\ValidationException;

/**
 * Class BaseRequest
 *
 * This class extends Laravel's FormRequest and provides a centralized way to handle validation failures.
 * It uses the ApiResponserTrait to format validation error responses consistently across the application.
 */
class BaseRequest extends FormRequest
{
    use ApiResponserTrait;

    /**
     * Handle a failed validation attempt.
     *
     * This method is triggered when validation fails for a request. It overrides the default behavior
     * to provide a custom error response using the `errorResponse` method from the ApiResponserTrait.
     *
     * @param Validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $exception = new \Exception();
        $response = $this->errorResponse($exception, HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}
