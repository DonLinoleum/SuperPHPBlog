<?php

return
[
    "~^articles/(\d+)$~" => [\Controllers\ArticleController::class,'view'],
    "~^articles/(\d+)/edit$~" => [\Controllers\ArticleController::class,'edit'],
    "~^articles/(\d+)/delete$~" => [\Controllers\ArticleController::class,'delete'],
    "~^articles/add$~" => [\Controllers\ArticleController::class,"add"],
    "~^$~" => [\Controllers\MainController::class,'main']
];


?>