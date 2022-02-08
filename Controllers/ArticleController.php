<?php
namespace Controllers;

use Models\Articles\Article;
use Models\Users\User;
use stdClass;

class ArticleController
{
    private $view;
  

    public function __construct()
    {
        $this->view = new \View\View(__DIR__ . "/../Templates");     
    }
    public function view(int $articleId)
    {
        $result = Article::getById($articleId);
        

        if ($result === null)
        {
            throw new \Exceptions\NotFoundException("хуй");
        }
           
        $this->view->renderHtml("/Articles/ViewArticle.php",['article'=>$result]);
        
    }

    public function edit ($articleId)
    {
        $result = Article::getById($articleId);
       
        if ($result === null)
        {
            throw new \Exceptions\NotFoundException("хуй");
        }
        
        $result->setName("Какой то pidr");
        $result->setText("хуйня какая то");
        $result->save();
    }

    public function add () : void
    {
        $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName("Супер статья про перец");
        $article->setText("Однажды перец сгнил и умер. Конец");

        $article->save();
       
    }

    public function delete($articleId)
    {
        $result = Article::getById($articleId);
        if ($result!==null)
        {
        var_dump($result);
        $result->delete($articleId);
        }
        else
        {
            $error = "Ашыпка. Не найден чото";
            $this->view->renderHtml("/Errors/ErrorDelete.php",['error'=>$error],404);
        }
    }
}





?>

