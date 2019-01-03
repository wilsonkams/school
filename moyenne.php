<?php
/*
 * Contrôleur de notre page d'accueil
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
	
	include_once("model/BDD.php");
	include_once("model/Notation.php");
	
	$titre = "Moyenne Générale";
	$page = "moyenne"; //__variable pour la classe "active" du menu-header
	
//__variables pour les balises méta
	$description = "Moyenne pour chaque étudiant";
    $title = "Notes des étudiants";
	$keyword = "mot-clé 1, mot-clé 2, mot-clé 3";
    $author = "Wilson KAMANGO";
	
    try {
    	$notation = new Notation();
		
		$moyennes = $notation->getMoyennes(); //_On affiche les eleves
		/*
		echo "<pre>";
		print_r($moyennes);
		echo "</pre>";
		exit;
		*/
    	require_once("view/vueMoyenne.php");
       
    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }
?>