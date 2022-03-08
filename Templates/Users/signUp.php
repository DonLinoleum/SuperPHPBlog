<?php
include_once (__DIR__ . "/../header.php");?>

<div>
    <h1>Регистрация</h1>
    <? if (!empty($error)): ?>
        <div style="background-color: red;padding:5px; margin:15px;"><?=$error?></div>
    <?endif;?>
    <form action="/users/register" method="post">
        <label>Nickname <input type="text" name="nickname" value="<?= $_POST['nickname'] ?? '' ?>"></label>
        <br><br>
        <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        <br><br>
        <label>Password <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
        <br><br>
        <button>Register!</button>
    </form>
</div>

<?include_once (__DIR__ . "/../footer.php")?>

