<?php
/*
 * Contrôleur de notre page d'accueil
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
	include_once("model/BDD.php");
	require_once("model/Form.php");
	
	$titre = "Contact";
	$page = "contact"; //__variable pour la classe "active" du menu-header
	
//__variables pour les balises méta
	$description = "Page de contact";
	$keyword = "";
    $author = "Wilson KAMANGO";
    $title = "Page de contact";
	
//__Nom et mail du propriétaire du formulaire
	$monNom = "Wilson KAMANGO";
	$destinataire = "wilson.kamango@gmail.com";
	
	
    try {
		if (isset($_POST) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message'])){
			extract($_POST);
		
			if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($sujet) && !empty($message)){
				$nom = $Formulaire->verifDataMail($nom);
				$prenom = $Formulaire->verifDataMail($prenom);
				$email = $Formulaire->verifDataMail($email);
				$sujet = $Formulaire->verifDataMail($sujet);
				$message = $Formulaire->verifDataMail($message);
				
				$data = new Formulaire(); // initialisation de la classe Formulaire
				$data->update($nom, $prenom, $email, $sujet, $message);
				
				//envoie des formulaires par mails
				$sujetMail = "Projet MarkerClusterer : ".$prenom." ".$nom." vous a envoyé un message avec le sujet suivant ".$sujet;
				$messageMail = "Un nouveau message est arrivé \n De la part de ".$prenom." ".$nom." \n
					Email : ".$email." \n
					sujet : ".$sujet." \n
					Message : ".$message." \n\n
				";
				$header = "From :".$nom."<".$email.">";
				mail($destinataire, $sujetMail, $messageMail, $header);
		
				// mail pour la personne qui rempli le formulaire
				$sujetMail = "tutoriel du Formulaire : message que vous avez envoyé";
				$messageMail = "Vous avez envoyé le message suivant
					Nom : ".$prenom." ".$nom." \n
					Email : ".$email." \n
					sujet : ".$sujet." \n
					Message : ".$message." \n\n
				";
				$header = "From :".$nom."<".$email.">";
				mail($email, $sujetMail, $messageMail, $header);
				
				$message = "<p class='success'>Message envoyé</p>";
				require_once("view/vueContact.php");
			} else {
				$message = "<p class='fail'>Message non envoyé</p>";
				require_once("view/vueContact.php");
			}
		} else {
			require_once("view/vueContact.php");
		}
		
    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }
?>