<?php

namespace Fahrplan\Controllers;

use Fahrplan\Exceptions\InvalidArgumentException;
use Fahrplan\Models\Users\UsersAuthService;
use Fahrplan\View\View;
use Fahrplan\Models\Users\User;

class UsersController
{
    private $view;

    public function __construct(){
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('user/register.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $this->view->renderHtml('user/registerSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('user/register.php');
    }

    public function login()
    {
        $user = UsersAuthService::getUserByToken();
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /www/');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('user/login.php', ['error' => $e->getMessage(), 'user' => $user]);
                return;
            }
        }

        $this->view->renderHtml('user/login.php', ['user'=>$user]);
    }

}