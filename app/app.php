<?php

// Register global error and exception handlers
use Symfony\Component\Debug\ErrorHandler;
ErrorHandler::register();
use Symfony\Component\Debug\ExceptionHandler;
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login' => array(
            'pattern' => '^/login$',
            'anonymous' => true
        ),
        'secured' => array(
            'pattern' => '^.*$',
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new GSB\DAO\VisiteurDAO($app['db']);
            }),
        ),
    ),
));

// Register services.
$app['dao.famille'] = $app->share(function ($app) {
    return new GSB\DAO\FamilleDAO($app['db']);
});
$app['dao.medicament'] = $app->share(function ($app) {
    $medicamentDAO = new GSB\DAO\MedicamentDAO($app['db']);
    $medicamentDAO->setFamilleDAO($app['dao.famille']);
    return $medicamentDAO;
});

$app['dao.type'] = $app->share(function ($app) {
    return new GSB\DAO\TypeDAO($app['db']);
});
$app['dao.visiteur'] = $app->share(function ($app) {
    return new GSB\DAO\VisiteurDAO($app['db']);
});
