<?php

namespace App\Http\Requests;

use App\Custom\Additional\Requires;
use App\Rules\AdminAccessRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $required = (bool) $request->isMethod('post');
        $admin = $request->user()->admin()->get()[0];
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'department_access.*' => [Requires::assign($required), Rule::in($admin->department_access)],
                'access.add' => [Requires::assign($required), 'boolean', new AdminAccessRule($admin->access['add'], $request->access['add']) ],
                'access.create' => [Requires::assign($required), 'boolean', new AdminAccessRule($admin->access['create'], $request->access['create']) ],
                'access.edit' => [Requires::assign($required), 'boolean', new AdminAccessRule($admin->access['edit'], $request->access['edit']) ],
                'access.delete' => [Requires::assign($required), 'boolean', new AdminAccessRule($admin->access['delete'], $request->access['delete']) ]
        ];

    }
}
