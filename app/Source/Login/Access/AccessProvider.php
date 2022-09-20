<?php

namespace App\Source\Login\Access;

use App\Models\Service;
use App\Models\User;

class AccessProvider extends Tokenable
{
    public User $user;
    public Service $service;

    public function __construct(User $user, Service $service)
    {
        $this->user = $user;
        $this->service = $service;
        $this->externalToken = $this->createAccess();
    }

    /*
     * Request to service for create token and return
     */
    public function createAccess (): string
    {
        return '5e3DNxr3ftdoAEQHgqU5sYmy8sShTIVqqpp88yIG';
    }


}
