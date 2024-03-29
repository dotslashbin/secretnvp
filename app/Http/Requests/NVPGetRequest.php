<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\UnixTimestamp;

/**
 * This class provides the structure for a "Get One" request
 */
class NVPGetRequest extends FormRequest
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
            'timestamp' => ['numeric', new UnixTimestamp]
        ];
    }

    protected function failedValidation(Validator $validator) {
        $output = FormatReturn($validator->errors(), config('app.NVPReturnStructures.ERROR'));
        throw new HttpResponseException(response()->json($output, 422));
    }
}
