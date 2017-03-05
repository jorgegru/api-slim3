<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO
$container['db'] = function ($c){
    try{
        $settings = $c->get('settings')['db'];
        $db = new \PDO($settings['driver'].':host='.$settings['host'].';dbname='.$settings['database'].';charset='.$settings['charset'], $settings['username'], $settings['password']); //Conexão
        $db -> setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION ); //habilitando erros do PDO
        return $db;
    } catch(\PDOException $e) {


        // registra("DB Falha na conexão : ".$e->getCode()." - ".$e->getMessage());
        exit("Desculpe o transtorno, houve uma falha em nosso sistema, por favor enviar a linha de erro abaixo ao administrador<hr /> Error -> Falha na conexão com o Banco de Dados -> ".date("d/n/Y G:i:s"));
     return false;
    }  
};   

// function registra($msg){
//     $container['logger']->info($msg);
// }