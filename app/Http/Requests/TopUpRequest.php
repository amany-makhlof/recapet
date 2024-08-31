<?php

namespace App\Http\Requests;

use App\Common\Enums\Message;
use App\Common\Traits\HasFailedValidationResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopUpRequest extends FormRequest
{
    use HasFailedValidationResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'balance' => 'required|numeric|min:0.01|max:99999',
        ];

        return $rules;
    }
     /**
    * Handle a failed validation attempt.
    *
    * @param  \Illuminate\Contracts\Validation\Validator  $validator
    * @return void
    */
   protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
   {
       if ($this->expectsJson()) {
           // API response
           throw new \Illuminate\Validation\ValidationException(
               $validator,
               response()->json([
                   'status' => false,
                   'message' => 'inputErrors',
                   'errors' => $validator->errors()
               ], 422)
           );
       }

       // Web response
       parent::failedValidation($validator);
   }
}
