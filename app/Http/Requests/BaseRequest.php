<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use \Illuminate\Contracts\Validation\Validator;

class BaseRequest extends FormRequest
{
  protected function failedValidation(Validator $validator)
  {
    $response = response()->json([
      'message' => 'Data tidak valid',
      'errors' => $validator->errors()
    ]);

    throw new ValidationException($validator, $response);
  }
}