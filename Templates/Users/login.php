<?php
include_once (__DIR__ . "/../header.php");
?>

<div style="text-align:center">
    <h1>Вход</h1>
    <?php if (!empty($error)):?>
        <div style="background-color:red;padding:5px;margin:15px;">
            <?=$error?>
        </div>
    <?php endif?>

    <form method="post">
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" value="<?=$_POST['email'] ?? ''?>"/>
        <br><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" value="<?=$_POST['password'] ?? ''?>"/>
        <br><br>
        <button>Войти</button>
    </form>
</div>
    

<?include_once (__DIR__ . "/../footer.php")?>

