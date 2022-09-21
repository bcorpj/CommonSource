<?php

namespace App\Http\Requests;

use App\Source\Additional\Requires;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        $required = (bool) $request->isMethod('post');

        return [
            'fullname' => [Requires::assign($required), 'string', 'min:3', 'max:255'],
            'login' => [Requires::assign($required), 'string', 'min:3', 'max: 100', 'unique:users,login'],
            'email' => [Requires::assign($required), 'string', 'unique:users,email'],
            'phone_number' => [Requires::assign($required), 'string', 'unique:users,phone_number']
        ];
    }

}
