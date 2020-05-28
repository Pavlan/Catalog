<?php


namespace app\models;


use app\core\Model;

class CategoryRepository extends Model
{
    protected const TABLE = 'category';
    private static $data = [];

    public static function getCategories(): array
    {
        return self::findAll();
    }

    public static function getCategoryChildsId(string $categoryId): array
    {
        $categoryChilds = self::findByParentId($categoryId);
        if ($categoryChilds) {
            foreach ($categoryChilds as $child) {
                self::$data[] = $child->id;
                self::getCategoryChildsId($child->id);
            }
        }
        return self::$data;
    }
}