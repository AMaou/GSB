<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type;
use GSB\Domain\Interaction;
use GSB\Form\Type\InteractionType;





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

// Ajouter interaction,

$app->match('/medicament/{id}/interaction/add', function(Request $request,$id) use ($app) {
	
	$array['medicament']=$app['dao.medicament']->find($id);
    $array['medicaments']=$app['dao.medicament']->findAll();
    $interaction = new Interaction();
	$interaction->setId($array['medicament']);
    $interactionForm = $app['form.factory']->create(new InteractionType($array['medicaments']), $interaction);

    $interactionForm->handleRequest($request);

    if ($interactionForm->isSubmitted() && $interactionForm->isValid()) {

        $app['dao.interaction']->save($interaction);

        $app['session']->getFlashBag()->add('success', 'Interaction ajoutée!');

    }
	$array['title'] = 'Ajout interaction '.$array['medicament'];
	$array['$interactionForm'] = $interactionForm->createView();

    return $app['twig']->render('interaction_form.html.twig',$array);

})->bind('interaction_add');


// supp interaction

$app->match('/medicament/{id}/interaction/delete/{medId}', function($id,$medId) use ($app) {

    $app['dao.interaction']->delete($id,$medId);

    $app['session']->getFlashBag()->add('success', 'Interaction supprimée!');

	$medicament =$app['dao.medicament']->find($id);
	$interaction =$app['dao.medicament']->findInteractions($id);

    return $app['twig']->render('medicament.html.twig', array('medicament' =>$medicament, 'interactions'=>$interaction));

})->bind('interaction_delete');

