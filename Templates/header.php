
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" constent="width=device-width,initial-scale=1.0"/>
    <title>Супер Блог</title>
    <link rel="stylesheet" href="/Templates/Main/styles.css">
</head>
<body>
    <div class="layout">
        <div class="header">
            <? if (!empty($user)):?>
                <p>
                    Здравствуй, <?=$user->getNickName()?> , <a href='/users/logout'>Выйти</a>
                </p>
                <?else:?>
                    <p>
                        <a href='/users/register'>Регистрация</a> |
                        <a href='/users/login'>Войти</a>
                    </p>
                    <?endif?>
        <div class="headerImgDiv">
            <h1><a href="/">Блог Веселого Гуся</a></h1>
            <img src="/Templates/Main/Img/goose.png"/>
        </div>
        </div>  
        <div class="content">
        <div class="sidebar">
    <h2>Меню:</h2>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="/about-me">Обо мне</a></li>
        <li><a href="/articles/add">Добавить статью</a></li>
    </ul>
    <img id="paper" src="/Templates/Main/Img/paper.png"/>
</div>
    <div class="main">
