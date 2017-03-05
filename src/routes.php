<?php
// Routes

// $app->add(function ($request, $response, $next) {
//         $getMediaType = $request->getMediaType();
//         if($getMediaType!='application/json'){

//             return $response->withJson(
//                 ["errors"=>
//                     [
//                         "detail"=>"O formato hipermídia '".$getMediaType."' fornecido é inválido. Formato suportado: application/json."
//                     ]
//                 ], 415);
//         }
// 	$response = $next($request, $response);
// 	return $response;
// });



$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->group('/v1', function(){
    $this->post('/voz', function ($request, $response) {

        $parsedBody = $request->getParsedBody();
        var_dump($parsedBody);

        // Render index view
        return 'jorge';
    });
})->add(new App\Middleware\JsonRequestMiddleware());
