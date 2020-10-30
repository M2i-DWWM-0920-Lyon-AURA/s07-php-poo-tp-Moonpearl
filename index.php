<?php

use App\Controller\MainController;
use App\Controller\TodoController;

// ================================================================
// Front controller
// ----------------------------------------------------------------
// ~ Toutes les requêtes sont redirigées sur ce fichier grâce au
// fichier .htaccess.
// ================================================================

// Active le chargement automatique des classes grâce à Composer
require 'vendor/autoload.php';

// Crée un nouveau routeur
$router = new AltoRouter();


// ================================================================
// Routes
// ----------------------------------------------------------------
// ~ Associe une fonction à chaque route disponible dans notre 
// application.
// ================================================================

// Page d'accueil
$router->map('GET', '/', function() {
	$controller = new MainController;
	$controller->home();
});

// Page des tâches à faire
$router->map('GET', '/todos', function() {
	$controller = new TodoController;
	$controller->list();
});

// Ajouter une nouvelle tâche
$router->map('POST', '/todos/new', function() {
	$controller = new TodoController;
	$controller->create();
});

// Modifier une tâche existante
$router->map('POST', '/todos/[i:id]/update', function(int $id) {
	$controller = new TodoController;
	$controller->update($id);
});


// ================================================================
// Routeur
// ----------------------------------------------------------------
// ~ Le routeur récupère la fonction associée à la route demandée
// et l'exécute, ou produit une page 404 si aucune route n'a été
// trouvée.
// ~ Cette partie du code vérifie que vous avez bien associé une
// fonction à chaque route, sinon elle produit une erreur.
// ================================================================

// Cherche une correspondance entre la requête de l'utilisateur et les routes connues
$match = $router->match();

// Si une correspondance a été trouvée
if( is_array($match)) {
	// Si la valeur renvoyée par le routeur n'est pas une fonction
	if (!is_callable( $match['target'] )) {
		// Produire une erreur
		$type = gettype($match['target']);
		return new TypeError("Routes must return a function ($type given).");
	}
	// Appelle la fonction associée à la route
	call_user_func_array( $match['target'], $match['params'] ); 
// Sinon
} else {
	// Renvoie la page 404 du serveur
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
