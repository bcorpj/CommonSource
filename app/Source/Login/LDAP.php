<?php

namespace App\Source\Login;

use App\Source\Login\LDAP\LDAPData;
use App\Models\User;

class LDAP extends LDAPData
{
    public static function init(User &$user): void
    {
        $LDAP = parent::getData($user->login);

        if ($user->password == $LDAP->password )
            return;

        $user->update([ 'password' => $LDAP->password ]);
        // Refresh user services password
        
    }

}
