<?php
include __DIR__ . "/../header.php";
                
                foreach($articles as $article): ?>
                <h2><a href='/articles/<?=$article->getId(); ?>'><?php echo $article->getName();  ?></a></h2> 
                <p><?= $article->getText();  ?></p>

                <? endforeach; 
include __DIR__ . "./../footer.php";
?>
  