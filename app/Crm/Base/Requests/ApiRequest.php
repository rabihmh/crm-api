<?php

namespace Crm\Base\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        if (!empty($errors)) {
            $transformedErrors = [];
//            foreach ($errors as $field => $message) {
//                dd($message, $field, $errors);
//                $transformedErrors = [
//                    $field => $message[0]
//                ];
//            }
            foreach ($errors as $field => $message) {
                array_push($transformedErrors, [$field => $message]);
            }
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'errors' => $transformedErrors
                ], Response::HTTP_BAD_REQUEST)
            );
        }
    }
}
