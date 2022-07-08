<?php

namespace App\Custom\Login;

use App\Custom\Login\LDAP\LDAPData;
use App\Models\User;

class LDAP extends LDAPData
{
    public static function init(User &$user): void
    {
        $LDAP = parent::getData($user->login);

        if ($user->password == $LDAP->password )
            return;

        $user->update([ 'password' => $LDAP->password ]);
    }

}
