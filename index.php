<?php
try
{
function loader(string $classname)
{
    require_once __DIR__ . "/" . str_replace("\\","/",$classname) . '.php';
}
spl_autoload_register('loader');

$route = $_GET['route'] ??  '';
$routes = require __DIR__ . "/routes.php";
$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction)
{
    preg_match($pattern,$route,$matches);
    if (!empty($matches))
    {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound)
{
    throw new \Exceptions\NotFoundException("Не найдено, пидр!");
}

unset ($matches[0]);


$controller = new $controllerAndAction[0]();
$method = $controllerAndAction[1];
$controller->$method(...$matches);
}
catch(\Exceptions\DBException $e)
{
   $view = new \View\View(__DIR__."/Templates/Errors/");
   $view->renderHtml("500.php",['error'=>$e->getMessage()],500);
}
catch (\Exceptions\NotFoundException $e)
{
    $view = new \View\View(__DIR__."/Templates/Errors/");
   $view->renderHtml("404.php",['error'=>$e->getMessage()],404);
}

?>