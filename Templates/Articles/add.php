<?php
include_once __DIR__ . "/../header.php"; ?>

<h1>Создание новой статьи!</h1>
<?php if (!empty($error)):?>
    <div style="color:red;"><?=$error?></div>
    <?endif?>
    <form action="/articles/add" method="post">
        <label for="name">Название статьи: </label><br>
        <input type="text" name="name" id="name" value="<?= $POST['name'] ?? '' ?>" size="50"><br>
        <br>
        <label for="text">Текст статьи</label><br>
        <textarea id="text" name="text" rows="10" cols="80"><?=$POST['text'] ?? '' ?></textarea><br>
        <br>
        <button>Добавить</button>

    </form>


<?include_once __DIR__ . "/../footer.php";
?>