<?php

namespace App\Source\Login;

use App\Source\Login\LDAP\LDAPData;
use App\Models\User;
use App\Source\Service\Intentions\Service;
use App\Source\Service\Resources\PasswordServiceResource;

class LDAP extends LDAPData
{
    public static function init(User &$user): void
    {
        $LDAP = parent::getData($user->login);

        if ($user->password == $LDAP->password )
            return;

        $user->update([ 'password' => $LDAP->password ]);

        // Refresh user services password
        Service::notify(PasswordServiceResource::class, $user, false);
    }

}
