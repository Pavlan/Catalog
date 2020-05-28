<?php

use app\views\CatalogLayout;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>Catalog</title>
</head>
<body>
    <main class="catalog">
        <h2 class="catalog__title">Catalog</h2>
        <div class="wrapper">
            <?php CatalogLayout::layout($this->categories) ?>
        </div>
    </main>
</body>
</html>