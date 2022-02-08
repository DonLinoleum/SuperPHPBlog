<?php
include_once (__DIR__ . "/../header.php");

echo "<h2>{$article->getName()}</h2>";
echo "<p>{$article->getText()}</p>";
echo "<p>Автор : <b>{$article->getAuthor()->getNickName()}</b></p>";

include_once (__DIR__ . "/../footer.php")

?>