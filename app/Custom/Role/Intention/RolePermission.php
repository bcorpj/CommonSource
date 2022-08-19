<?php

namespace App\Custom\Role\Intention;

use Illuminate\Http\Request;

abstract class RolePermission
{
    protected Request $request;

    protected static array $service_access = [
        'admin' => 'common-admin',
        'user' => 'common-user'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function is_edit_safe(): bool
    {
        return $this->rules($this->request);
    }

    public function exec (): string
    {
        return $this->rules($this->request);
    }

    abstract function rules (Request $request);
}
