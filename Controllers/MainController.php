<?php
namespace Controllers;

use Models\Users\UserActivationService;
use Models\Users\UsersAuthService;

class MainController extends AbstractController
{

    public function main()
    {

        $articles = \Models\Articles\Article::findAll();
        $this->view->renderHtml("/Main/Main.php",[
            "articles"=>$articles,
            'user'=>UsersAuthService::getUserByToken()
        ]);
       
    }
    
}






?>
