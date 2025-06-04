<?php
declare(strict_types=1);
use Slim\App;
return function (App $app) {
   // Nhóm Auth
    (require dirname(__DIR__) . '/src/Routes/AuthRoutes.php')($app);
};
