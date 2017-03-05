<?php
namespace App\Middleware;


class JsonRequestMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
         $getMediaType = $request->getMediaType();
        if($getMediaType!='application/json'){

            return $response->withJson(
                ["errors"=>
                    [
                        "detail"=>"O formato hipermídia '".$getMediaType."' fornecido é inválido. Formato suportado: application/json."
                    ]
                ], 415);
        }
        $response = $next($request, $response);
        return $response;
    }
}
