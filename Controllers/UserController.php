<?
namespace Controllers;

use InvalidArgumentException;
use Models\Users\User;
use Models\Users\UserActivationService;
use Models\Users\UsersAuthService;
use Services\EmailSender;
use View\View;

class UserController extends AbstractController
{


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
            $code = UserActivationService::createActivationCode($user);

            EmailSender::send($user,"KOT PUKNUL","userActivation.php",
            ["userId"=>$user->getId(),"code"=>$code]);
            header("Location: http://localhost");
            return;
        }

        $this->view->renderHtml("/Users/signUp.php");
    }

    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user,$activationCode);
        if ($isCodeValid)
        {
            $user->activate();
            echo "OK!";
        }
    }

    public function login()
    {
        if (!empty($_POST))
        {
            try
            {
            $user = User::login($_POST);
            UsersAuthService::createToken($user);
            header("Location: /");
            exit();
            }
        
        catch (InvalidArgumentException $e)
        {
            $this->view->renderHtml('/users/login.php',['error'=>$e->getMessage()]);
            return;
        }
    }
      
        $this->view->renderHtml("/users/login.php");   
    }
        
    public function logout()
    {
        $user = UsersAuthService::getUserByToken();
        if ($user)
        {
        UsersAuthService::deleteToken($user);
        header("Location: /");
        }
    
    }


}


?>