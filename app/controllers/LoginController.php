<?php


namespace app\controllers;


use app\core\View;
use app\models\UserRepository;

class LoginController
{
    private $view;
    private $data = [];

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function actionIndex(): void
    {
        if (self::isLogin()) {
            header('Location: /catalog');
            exit();
        }
        $this->view->display('loginForm.php', $this->data);
    }

    public function actionLogin(): void
    {
        if ($_POST['name'] && $_POST['password']) {
            if (UserRepository::validate($_POST['name'], $_POST['password'])) {
                $_SESSION['user'] = $_POST['name'];
            } else {
                $this->data['errorMessage'] = 'Invalid name or password';
            }
        } else {
            $this->data['errorMessage'] = 'Name or password is required';
        }
        $this->actionIndex();
    }

    public static function isLogin(): bool
    {
        return isset($_SESSION['user']);
    }
}