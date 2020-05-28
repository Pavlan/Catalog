<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>Login</title>
</head>
<body>
    <form class="form" action="/login/login" method="post">
        <span class="form__error-message"><?= $this->errorMessage ?></span>
        <label class="form__label" for="name">Name<sup>*</sup></label>
        <input class="form__input" id="name" type="text" name="name">
        <label class="form__label" for="password">Password<sup>*</sup></label>
        <input class="form__input" id="password" type="text" name="password">
        <button class="form__btn" type="submit">Login</button>
    </form>
</body>
</html>