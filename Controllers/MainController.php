<?php
namespace Controllers;


class MainController
{
   private $view;

   public function __construct()
   {
       $this->view = new \View\View (__DIR__ . "/../Templates");
       
   }

    public function main()
    {

        $articles = \Models\Articles\Article::findAll();
        $this->view->renderHtml("/Main/Main.php",["articles"=>$articles]);
       
    }
    
}






?>
