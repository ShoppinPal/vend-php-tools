<?php

namespace Www\Helper\Controller;

use YapepBase\Session\ISession;

use Www\Helper\SessionHelper;

class AuthenticationHelper
{

    /**
     * @var \YapepBase\Session\ISession
     */
    protected $session;

    /**
     * Constructor
     *
     * @param \YapepBase\Session\ISession $session The session object to work on.
     */
    public function __construct(ISession $session)
    {
        $this->session = $session;
    }

    /**
     * Returns TRUE if the current user is signed in.
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return (isset($this->session[SessionHelper::KEY_USER_ID]) && $this->session[SessionHelper::KEY_USER_ID]);
    }

    /**
     * Returns the currently logged in user's ID or FALSE if none is logged in.
     *
     * @return bool|int
     */
    public function getLoggedInUserId()
    {
        if (!isset($this->session[SessionHelper::KEY_USER_ID])) {
            return false;
        }
        return $this->session[SessionHelper::KEY_USER_ID];
    }


    /**
     * Returns the currently logged in user's username or FALSE if none is logged in.
     *
     * @return bool|string
     */
    public function getLoggedInUsername()
    {
        if (!isset($this->session[SessionHelper::KEY_USERNAME])) {
            return false;
        }
        return $this->session[SessionHelper::KEY_USERNAME];
    }

    /**
     * Returns the currently logged in user's username or FALSE if none is logged in.
     *
     * @return bool|string
     */
    public function getLoggedInEmail()
    {
        if (!isset($this->session[SessionHelper::KEY_EMAIL])) {
            return false;
        }
        return $this->session[SessionHelper::KEY_EMAIL];
    }

    /**
     * Logs the specified user in.
     *
     * @param string $username The name of the user.
     * @param array  $email    The email of the logged in user
     *
     * @return void
     */
    public function logIn($userId, $username, $email)
    {
        $this->session[SessionHelper::KEY_USER_ID]  = $userId;
        $this->session[SessionHelper::KEY_USERNAME] = $username;
        $this->session[SessionHelper::KEY_EMAIL]    = $email;
    }

    /**
     * Logs the user out if there is one logged in.
     *
     * @return void
     */
    public function logOut()
    {
        if ($this->isLoggedIn()) {
            unset($this->session[SessionHelper::KEY_USER_ID]);
            unset($this->session[SessionHelper::KEY_USERNAME]);
            unset($this->session[SessionHelper::KEY_EMAIL]);
        }
    }
}
