<?
namespace Controllers;

use InvalidArgumentException;
use Models\Users\User;
use View\View;
class UserController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . "/../Templates" );
    }

    public function signUp ()
    {
        $user = null;
        if (!empty($_POST))
        {
            try
            {
                $user = User::signUp($_POST);
            }
            catch (InvalidArgumentException $e)
            {
                $this->view->renderHtml("/Users/signUp.php",['error'=>$e->getMessage()]);
                return;
            }
        }

        if ($user instanceof User)
        {
            $this->view->renderHtml('/users/signUpSuccess.php');
            return;
        }

        $this->view->renderHtml("/Users/signUp.php");
    }

}



?>