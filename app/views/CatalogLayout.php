<?php


namespace app\views;


class CatalogLayout
{
    public static function layout($categories, $parentId = 0): void
    {
        if (isset($categories[$parentId])): ?>
            <ul class="catalog__list">
            <?php foreach ($categories[$parentId] as $category):
                if ($parentId === 0): ?>
                    <li class="catalog__item catalog__item--first">
                <?php else: ?>
                    <li class="catalog__item">
                <?php endif; ?>
                        <div class="catalog__container">
                            <span class="catalog__item-title"><?= $category->title ?></span>
                            <span class="catalog__item-desc"><?= $category->description ?></span>
                        </div>
                        <div class="catalog__container">
                            <a class="catalog__btn catalog__btn--edit" href="/category/edit/<?= $category->id ?>">Edit</a>
                            <a class="catalog__btn catalog__btn--delete" href="/category/delete/<?= $category->id ?>">Delete</a>
                        </div>
                    </li>

                <?php self::layout($categories, $category->id);
            endforeach; ?>
            </ul>
        <?php endif;
    }
}