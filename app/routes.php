<?php

use Symfony\Component\HttpFoundation\Request;
//
// Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');

// Détails sur un médicament
$app->get('/medicament/{id}', function($id) use ($app) {
    $medicament = $app['dao.medicament']->find($id);
	$interactions = $app['dao.medicament']->findInteractions($id);
    return $app['twig']->render('medicament.html.twig', array('medicament' => $medicament, 'interactions' => $interactions));
})->bind('medicament');

// Liste de tous les médicaments
$app->get('/medicament/', function() use ($app) {
    $medicaments = $app['dao.medicament']->findAll();
    return $app['twig']->render('medicaments.html.twig', array('medicaments' => $medicaments));
})->bind('medicaments');

// Recherche de médicaments
$app->get('/medicament/recherche/', function() use ($app) {
    $familles = $app['dao.famille']->findAll();
    return $app['twig']->render('medicaments_recherche.html.twig', array('familles' => $familles));
})->bind('medicament_recherche');

// Résultats de la recherche de médicaments
$app->post('/medicament/resultats/', function(Request $request) use ($app) {
   if( $request->request->has('famille') &&  $request->request->has('nom')) {
		$nomCommercial = $request->request->get('nom');
	   	$familleId = $request->request->get('famille');
        $medicaments = $app['dao.medicament']->findAllByNomFamille($nomCommercial, $familleId);
   }
  
    return $app['twig']->render('medicaments_resultats.html.twig', array('medicaments' => $medicaments));
})->bind('medicament_resultats');



// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

