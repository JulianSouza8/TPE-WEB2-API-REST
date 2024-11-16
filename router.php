<?php
require_once 'libs/router.php';
require_once 'app/controller/controllerProveedores.php';

require_once 'app/middleware/jwt.auth.middleware.php';

$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());


$router->addRoute('proveedores','GET','controllerProveedores','getProveedores');
$router->addRoute('proveedores/:id','GET','controllerProveedores','getProveedor');
$router->addRoute('proveedores/:id','DELETE','controllerProveedores','deleteProveedor');
$router->addRoute('proveedores','POST','controllerProveedores','addProveedor');
$router->addRoute('proveedores/:id','PUT','controllerProveedores','updateProveedor');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);