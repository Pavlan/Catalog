<?php


namespace app\controllers;


use app\core\View;
use app\models\CategoryRepository;
use http\Exception\RuntimeException;
use stdClass;

class CategoryController
{
    private $view;
    private $params;
    private $data = [];

    public function __construct(View $view, $params)
    {
        $this->view = $view;
        $this->params = $params;
    }

    public function actionEdit(): void
    {
        if ($this->isLogin()) {
            $this->data['category'] = $this->getCategory();
            if ($this->data['category']) {
                $this->view->display('editForm.php', $this->data);
            } else {
                throw new RuntimeException('Page not found', 404);
            }
        }
    }

    public function actionDelete(): void
    {
        if ($this->isLogin()) {
            $deleteId = CategoryRepository::getCategoryChildsId($this->params);
            $deleteId[] = $this->params;
            CategoryRepository::delete($deleteId);
            header("Location: /catalog");
            exit();
        }
    }

    public function actionSave(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = $this->getCategory();
            if ($category) {
                $category->title = $_POST['title'];
                $category->description = $_POST['description'];
                CategoryRepository::update($category);
            }
        }
        header("Location: /catalog");
        exit();
    }

    private function isLogin(): ?bool
    {
        if (LoginController::isLogin()) {
            return true;
        }
        header('Location: /');
        exit();
    }

    private function getCategory(): ?stdClass
    {
        return CategoryRepository::findById($this->params);
    }
}