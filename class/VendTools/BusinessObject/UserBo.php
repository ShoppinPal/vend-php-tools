<?php
namespace VendTools\BusinessObject;

use VendTools\Dao\Table\Vend\UserTable;
use YapepBase\Config;

class UserBo extends BoAbstract
{
    public function checkIfUserExists($username)
    {
        return (bool)$this->getUserDao()->getByUserName($username);
    }

    public function create($username, $password, $email)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT, [
            'cost' => Config::getInstance()->get('application.passwordHash.cost'),
        ]);

        return $this->getUserDao()->create($username, $passwordHash, $email);
    }

    public function authenticate($username, $password)
    {
        // TODO update the hash cost if it's lower then configured

        $user = $this->getUserDao()->getByUserName($username);

        if (empty($user)) {
            // Avoid timing attacks
            password_verify('aaaa', '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq');
            return false;
        } elseif (password_verify($password, $user[UserTable::FIELD_PASSWORD])) {
            unset($user[UserTable::FIELD_PASSWORD]);
            return $user;
        }

        return false;
    }
}
