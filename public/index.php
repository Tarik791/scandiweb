<?php
// backend/public/index.php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE"); 
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '/../vendor/autoload.php';

// Create a dispatcher
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/products', [App\Controller\ProductController::class, 'getProducts']);
    $r->post('/products', [App\Controller\ProductController::class, 'addProduct']);
    $r->delete('/products', [App\Controller\ProductController::class, 'deleteProducts']);
});

$routeInfo = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
    
        [$controller, $method] = $handler;
        $controllerInstance = new $controller();
        
        $input = json_decode(file_get_contents('php://input'), true);
        echo $controllerInstance->$method($input);
        break;
}
