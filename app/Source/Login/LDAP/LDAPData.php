<?php

namespace App\Source\Login\LDAP;

class LDAPData
{
    public string $id;
    public string $login;
    public string $password;

    /**
     * @param string $id
     * @param string $login
     * @param string $password
     */
    public function __construct(string $id, string $login, string $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    protected static function getData (string $login): LDAPData
    {
        $data = [
            'userid' => '2908',
            'login'=> 'r.b',
            'password' => 'daaad6e5604e8e17bd9f108d91e26afe6281dac8fda0091040a7a6d7bd9b43b5'  // 17f80754644d33ac685b0842a402229adbb43fc9312f7bdf36ba24237a1f1ffb
        ];

        return new LDAPData($data['userid'], $login, $data['password']);
    }

}
