<?php
/*
 * Contrôleur de notre page de maps
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
	
	include_once("model/BDD.php");
	include_once("model/Notation.php");
	
	$titre = "formulaire";
	$page = "formulaire"; //__variable pour la classe "active" du menu-header
	
//__variables pour les balises méta
	$description = "Formulaire d'ajout de note";
    $title = "Formulaire d'ajout de note";
	$keyword = "";
    $author = "Guillaume RICHARD";
	
    try {
    	$notation = new Notation();
		
		$eleves = $notation->getEleves(); //_On affiche les eleves
		$matieres = $notation->getMatieres(); //_On affiche les matières
		
		if(!empty($_POST)){
			//__print_r($_POST);
			
			$idEleve = $_POST['eleve'];
			$idMatiere = $_POST['matiere'];
			$note = $_POST['note'];
			
			//__Table note : id_note - idnote_etudiant - idnote_matiere - valeur_note
			$notation->updateNote($idEleve, $idMatiere, $note);
			
			$nomEleves = $notation->getElevesId( $idEleve );
			$nomEleve = $nomEleves->prenom_etudiant." ".$nomEleves->nom_etudiant;
			
			$nomMatieres = $notation->getMatieresId( $idMatiere );
			$nomMatiere = $nomMatieres->nom_matiere;
			
			$message = "l'élève ".$nomEleve." a eu un ".$note." en ".$nomMatiere;
		}
		
    	require_once("view/vueFormulaire.php");
       
    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }
?>
