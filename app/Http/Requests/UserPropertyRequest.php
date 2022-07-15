<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPropertyRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:App\Models\User,id'],
            'position_id' => ['nullable', 'integer', 'exists:App\Models\Position,id'],
            'department_id' => ['nullable', 'integer', 'exists:App\Models\Department,id']
        ];
    }
}
