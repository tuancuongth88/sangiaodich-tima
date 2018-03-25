<?php

namespace App\Http\Requests\Systems;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:5',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => 'Bạn chưa nhập :attribute',
            'name.max'      => ':attribute không quá 255 ký tự',
        ];
    }
}
