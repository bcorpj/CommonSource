<?php

namespace App\Http\Requests;

use App\Custom\Additional\Requires;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PositionRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $required = (bool) $request->isMethod('post');

        return [
            'id' => [Requires::assign(!$required), 'integer', !$required ? 'exists:positions,id' : ''],
            'name' => [Requires::assign($required), 'string'],
            'type' => ['nullable', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
