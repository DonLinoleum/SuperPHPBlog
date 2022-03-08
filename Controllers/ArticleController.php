<?php
namespace Controllers;

use Exceptions\UnauthorizedException;
use InvalidArgumentException;
use Models\Articles\Article;
use Models\Users\User;
use stdClass;

class ArticleController extends AbstractController
{
  
  
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
        $article = Article::getById($articleId);
       
        if ($article === null)
        {
            throw new UnauthorizedException();
        }
        
        if (!empty($_POST))
        {
            try
            {
                $article->updateFromArray($_POST);
            }
            catch(InvalidArgumentException $e)
            {
                $this->view->renderHtml('/Articles/edit.php',['error'=>$e->getMessage(),'article'=>$article]);
                return;
            }
            header("Location: /articles/" . $article->getId(),true,302);
            die();
        }

        $this->view->renderHtml('/Articles/edit.php',['article'=>$article]);

    }

    public function add () : void
    {
        if ($this->user === null){
            throw new UnauthorizedException();
        }

        if (!empty($_POST))
        {
            try
            {
                $article = Article::createFromArray($_POST,$this->user);
            }
            catch(InvalidArgumentException $e)
            {
           
                    $this->view->renderHtml('/Articles/add.php',['error'=>$e->getMessage()]);
                    return;
            }

            header("Location: /articles/" . $article->getId(),true,302);
            die();
        }
        
        $this->view->renderHtml('/articles/add.php');
    }

    public function delete($articleId)
    {
        $result = Article::getById($articleId);
        
        if ($result!==null)
        {
        $result->delete($articleId);
        header("Location: /");
        }
        
        else
        {
            $error = "Ашыпка. Не найден чото";
            $this->view->renderHtml("/Errors/ErrorDelete.php",['error'=>$error],404);
        }
    }
}


?>

