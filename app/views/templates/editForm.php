<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>Edit</title>
</head>
<body>
    <form class="form" action="/category/save/<?= $this->category->id ?>" method="post">
        <label class="form__label" for="title">Title</label>
        <input class="form__input" id="title" type="text" name="title" value="<?= $this->category->title ?>">
        <label class="form__label" for="description">Description</label>
        <textarea class="form__input form__input--textarea" id="description" name="description" rows="5"><?= $this->category->description ?></textarea>
        <button class="form__btn" type="submit">Save</button>
    </form>
</body>
</html>