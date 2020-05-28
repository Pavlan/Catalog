<?php


namespace app\controllers;


use app\core\View;
use app\models\CategoryRepository;

class CatalogController
{
    private $data = [];
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function actionIndex(): void
    {
        if (!LoginController::isLogin()) {
            header('Location: /');
            exit();
        }
        $this->setCategories();
        $this->showCatalog();
    }

    private function setCategories(): void
    {
        $categories = CategoryRepository::getCategories();
        if ($categories) {
            $this->data['categories'] = $this->sortCategories($categories);
        }
    }
    
    private function showCatalog(): void
    {
        $this->view->display('catalog.php', $this->data);
    }

    private function sortCategories(array $categories): array
    {
        $preparedCategories = [];
        foreach ($categories as $category) {
            $preparedCategories[$category->parentId][] = $category;
        }
        return $preparedCategories;
    }
}