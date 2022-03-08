<?
namespace Controllers;

use Models\Users\User;
use Models\Users\UsersAuthService;
use View\View;

abstract class AbstractController
{
    protected $view;
    protected $user;

    public function __construct()
   {
       $this->user = UsersAuthService::getUserByToken();
       $this->view = new \View\View (__DIR__ . "/../Templates");
       $this->view->setVar('user',$this->user);
       
   }
}


?>