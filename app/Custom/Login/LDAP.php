<?php

namespace App\Custom\Login;

use App\Custom\Debug\Record;
use App\Custom\Login\Anil\TokenProvider;
use App\Custom\Login\LDAP\LDAPData;
use App\Models\User;

class LDAP extends LDAPData
{
    public static function init(User &$user): void
    {
        $LDAP = self::getData($user->login);

        if ($user->password == $LDAP->password )
            return;

        $user->update([ 'password' => $LDAP->password ]);
    }

}
