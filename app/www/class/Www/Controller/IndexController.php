<?php

namespace Www\Controller;

use VendTools\Dao\Table\Vend\UserTable;
use Www\View\Template\IndexIndexTemplate;
use Www\View\Template\IndexLoginTemplate;
use Www\View\Template\IndexSignUpTemplate;
use YapepBase\Application;

class IndexController extends BaseControllerAbstract
{

    protected function before()
    {
        parent::before();

        Application::getInstance()->getDispatchedAction($controllerName, $action);

        if ($action != 'Logout' && $this->authenticationHelper->isLoggedIn()) {
            $this->redirectToRoute('Store', 'List');
        }
    }

    protected function doIndex()
    {
        return new IndexIndexTemplate();
    }

    protected function doSignUp()
    {
        $errors = [];
        if ($this->request->hasPost('submit')) {
            $username  = (string)$this->request->getPost('username');
            $password  = (string)$this->request->getPost('password');
            $password2 = (string)$this->request->getPost('password2');
            $email     = (string)$this->request->getPost('email');
            $userBo    = $this->getUserBo();

            if (strlen($username) < 3 || strlen($username) > 50) {
                $errors['username'] = 'The username must be between 3 and 50 characters long';
            } elseif ($userBo->checkIfUserExists($username)) {
                $errors['username'] = 'The specified username already exists';
            }

            if (strlen($password) < 6) {
                $errors['password'] = 'The password has to be at least 6 characters long';
            } elseif ($password !== $password2) {
                $errors['password'] = 'The entered passswords do not match';
            }

            if (empty($email)) {
                $errors['email'] = 'The email is empty';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'The entered email address is not valid';
            }

            if (empty($errors)) {
                $userId = $userBo->create($username, $password, $email);
                $this->authenticationHelper->logIn($userId, $username, $email);
                $this->redirectToRoute('Store', 'List');
            }
        }

        $this->setToView(
            [
                'errors' => $errors,
            ]
        );

        return new IndexSignUpTemplate('errors');
    }

    protected function doLogin()
    {
        $errors = [];
        if ($this->request->hasPost('submit')) {
            $username = (string)$this->request->getPost('username');
            $password = (string)$this->request->getPost('password');

            if (empty($username) || empty($password)) {
                $errors[] = 'Both the username and the password must be filled in';
            }

            if (empty($errors)) {
                $user = $this->getUserBo()->authenticate($username, $password);

                if (empty($user)) {
                    $errors[] = 'Invalid username or password';
                } else {
                    $this->authenticationHelper->logIn(
                        $user[UserTable::FIELD_ID],
                        $user[UserTable::FIELD_USERNAME],
                        $user[UserTable::FIELD_EMAIL]
                    );
                    $this->redirectToRoute('Store', 'List');
                }
            }
        }

        $this->setToView(
            [
                'errors' => $errors,
            ]
        );

        return new IndexLoginTemplate('errors');
    }

    protected function doLogout()
    {
        $this->authenticationHelper->logOut();
        $this->redirectToRoute('Index', 'Login');
    }
}
