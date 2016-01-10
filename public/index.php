<?php
/**
 * Slim Router
 *
 * @author Aaron Saray
 */

use AboutBrowser\Util\Di;


require __DIR__ . '/../src/bootstrap.php';

$app = new \Slim\Slim(array(
    'templates.path'    =>  __DIR__ . '/../src/Templates'
));

/**
 * Mode / Environment based configuration
 */
$app->config('mode', 'development');

$app->configureMode('development', function() use ($app) {
    $app->config(array(
        'debug' =>  true
    ));
});
$app->configureMode('production', function() use ($app) {
    $app->config(array(
        'debug' =>  false,
        'log.enabled' => true,
        'log.level' =>  \Slim\Log::WARN
    ));
});

/**
 * Handle the 404's
 * @param \Slim\Slim $app
 */
function notFoundHandler($app)
{
    $app->render('404.php', array(), 404);
}

// new visitor
$app->get('/', function() use ($app) {
    $visitorService = Di::getInstance()['visitorService'];
    $id = $visitorService->storeNewVisitor($_SERVER);
    $url = $app->urlFor('viewer_route', array('id'=>$id));
    $app->response->redirect($url, 302);
});

// returning visitor, shared link or source of redirect
$app->get('/me/:id', function($id) use ($app) {
    $visitorService = Di::getInstance()['visitorService'];
    $visitor = $visitorService->findByPublicID($id);
    if ($visitor) {
        $app->render('display.php', array('visitor' => $visitor));
    }
    else {
        notFoundHandler($app);
    }
})->name('viewer_route');

// update the javascript values
$app->post('/me/:id/js', function($id) use ($app) {
    $visitorService = Di::getInstance()['visitorService'];
    $visitor = $visitorService->findByPublicID($id);
    if ($visitor) {
        $visitor->setJavascriptData($app->request->post());
        $visitorService->save($visitor);
    }
});


// found message - most likely an expired item
$app->notFound(function() use ($app) {
    notFoundHandler($app);
});


/**
 * Finally run app.
 */
$app->run();