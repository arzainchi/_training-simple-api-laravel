<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PengarangRequest extends FormRequest
{
    public $validator = null;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "nama" => "required",
            "jenis_kelamin" => "required|in:L,P",
            "tanggal_lahir" => "required|date",
            "alamat" => "required",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
