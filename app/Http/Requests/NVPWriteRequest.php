<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * This provides a structure for the "write" request.
 */
class NVPWriteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required|alpha_num',
            'value' => 'alpha_num'
        ];
    }

    protected function failedValidation(Validator $validator) {
        $output = FormatReturn($validator->errors(), config('app.NVPReturnStructures.ERROR'));
        throw new HttpResponseException(response()->json($output, 422));
    }
}
