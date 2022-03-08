<?php
include_once (__DIR__ . "/../header.php");?>

<h2><?=$article->getName()?></h2>
<p><?=$article->getText()?></p>
<p>Автор : <b><?=$article->getAuthor()->getNickName()?></b></p>

<p><a href='/articles/<?=$article->getId();?>/delete'><b>Удалить<b></a></p>

<?include_once (__DIR__ . "/../footer.php")?>