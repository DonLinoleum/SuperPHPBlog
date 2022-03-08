<?php

return
[
    "~^articles/(\d+)$~" => [\Controllers\ArticleController::class,'view'],
    "~^articles/(\d+)/edit$~" => [\Controllers\ArticleController::class,'edit'],
    "~^articles/(\d+)/delete$~" => [\Controllers\ArticleController::class,'delete'],
    "~^articles/add$~" => [\Controllers\ArticleController::class,"add"],
    "#^users/register$#" => [\Controllers\UserController::class,"signUp"],
    "~^users/(\d+)/activate/(.+)$~" => [\Controllers\UserController::class,'activate'],
    "~^users/login$~"=> [\Controllers\UserController::class,'login'],
    "~^users/logout$~" => [\Controllers\UserController::class,'logout'],
    "~^$~" => [\Controllers\MainController::class,'main']
];


?>