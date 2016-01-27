<?php

namespace Www\Controller;

use Www\BusinessObject\TBoGetter;
use Www\Helper\Controller\AuthenticationHelper;
use YapepBase\Application;
use YapepBase\Controller\HttpController;
use YapepBase\Session\ISession;

abstract class BaseControllerAbstract extends HttpController
{
    use TBoGetter;

    /**
     * @var ISession
     */
    protected $session;

    /**
     * @var AuthenticationHelper
     */
    protected $authenticationHelper;

    protected function before()
    {
        parent::before();
        $this->session = Application::getInstance()->getDiContainer()->getSessionRegistry()->getSession('www');
        $this->authenticationHelper = new AuthenticationHelper($this->session);

        if (!$this->authenticationHelper->isLoggedIn() && IndexController::class !== get_class($this)) {
            $this->redirectToRoute('Index', 'Login');
        }
    }

}
