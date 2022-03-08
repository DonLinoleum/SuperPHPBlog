<?php
include_once __DIR__ . "/../header.php"; ?>

<h1>Редактирование статьи!</h1>

<?php if (!empty($error)):?>
    <div style="color:red;"><?=$error?></div>
    <?endif?>

    <form action="/articles/<?=$article->getId()?>/edit" method="post">
        <label for="name">Название статьи: </label><br>
        <input type="text" name="name" id="name" value="<?=$_POST['name'] ?? $article->getName();?>" size="50"><br>
        <br>
        <label for="text">Текст статьи</label><br>
        <textarea id="text" name="text" rows="10" cols="80"><?=$_POST['text'] ?? $article->getText();?></textarea><br>
        <br>
        <button>Обновить</button>

    </form>


<?include_once __DIR__ . "/../footer.php";
?>