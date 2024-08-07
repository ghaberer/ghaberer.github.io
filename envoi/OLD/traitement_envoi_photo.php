<?php

$formulaire_valide = True; // par défaut les données sont valides

function traitement($nom) // uniformisation de la chaîne de caractères $nom
{
	$nom = strip_tags($nom); //suppression des balises html ou php
	$nom = str_replace(array(' ', '\'', ',', '?', ';', '.', '/', '\\', '!', ':'),'',$nom);
	$nom = trim($nom); // supprime les caractères invisibles en début et fin de chaîne
	// On enlève les accents :
	$nom = strtolower($nom); //met en minuscule
	//On supprime les caractères parasites :
	
	$nom = str_replace(
		  array(
				'à', 'â', 'ä', 'á', 'ã', 'å',
				'î', 'ï', 'ì', 'í', 
				'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
				'ù', 'û', 'ü', 'ú', 
				'é', 'è', 'ê', 'ë', 
				'ç', 'ÿ', 'ñ', 
		  ),
		  array(
				'a', 'a', 'a', 'a', 'a', 'a', 
				'i', 'i', 'i', 'i', 
				'o', 'o', 'o', 'o', 'o', 'o', 
				'u', 'u', 'u', 'u', 
				'e', 'e', 'e', 'e', 
				'c', 'y', 'n', 
		  ),
		  $nom);
	return $nom;
}

//Vérification du fichier (envoi, taille, extension)	
if ($_FILES['fichier']['error']==4)
	{
		$messageErreurFichier='Aucun fichier n\'a été sélectionné...';	
		$formulaire_valide = False;
	}
elseif ($_FILES['fichier']['size']>50000000 OR $_FILES['fichier']['error']==1)
	{
		$messageErreurFichier= 'La taille du fichier est trop importante. Vérifiez votre fichier ';
		$formulaire_valide = False;
	}
elseif (!isset($_FILES['fichier']) OR $_FILES['fichier']['error']!=0)
	{
		$messageErreurFichier='Un problème technique a eu lieu lors du tranfert. Merci de réessayer.';
		$formulaire_valide = False;
	}
/* elseif (pathinfo($_FILES['fichier']['name'],PATHINFO_EXTENSION)!='py') */
/* 	{ */
/* 		$messageErreurFichier= 'Seuls les fichiers ".py" sont acceptés dans ce formulaire. Vérifiez votre fichier .'; */
/* 		$formulaire_valide = False; */
/* 	} */

// Vérification Noms
if (!isset($_POST['Nom1']) OR trim($_POST['Nom1'])=='')
	{
		$messageErreurNom = 'Veuillez rentrer votre nom';
		$formulaire_valide = False;
	}
else
	{ // Nom non vide -> à traiter
		$nom1 = $_POST['Nom1'];
		$nom1 = traitement($nom1);
	}
	
if (!isset($_POST['Prenom1']) OR trim($_POST['Prenom1'])=='')
	{
	  $prenom1 = '';
	}
else
	{ // Nom non vide -> à traiter
		$prenom1 = $_POST['Prenom1'];
		$prenom1 = traitement($prenom1);
	}

/* if (!isset($_POST['Nom2']) OR trim($_POST['Nom2'])=='') */
/* 	{ */
/* 		$nom2 = 'tout'; */
/* 	} */
/* else */
/* 	{ // Nom2 non vide -> à traiter */
/* 		$nom2 = $_POST['Nom2']; */
/* 		$nom2 = traitement($nom2); */
/* 		$nom2 = '_'.$nom2; */
/* 	} */

/* if (!isset($_POST['Prenom2']) OR trim($_POST['Prenom2'])=='') */
/* 	{ */
/* 	  $prenom2 = 'seul'; */
/* 	} */
/* else */
/* 	{ // Nom non vide -> à traiter */
/* 		$prenom2 = $_POST['Prenom2']; */
/* 		$prenom2 = traitement($prenom2); */
/* 	} */

/* // Vérification classe */
/* if (!isset($_POST['classe']) OR !in_array($_POST['classe'], $liste_classes)) */
/* { */
/* 	$messageErreurClasse = 'Classe non précisée.'; */
/* 	$formulaire_valide = False; */
/* } */
/* else */
/* { //classe valide */
/* 	$classe = $_POST['classe'];	 */
/* } */


if ($formulaire_valide)
{
		//Détermination des coordonnées temporelles
		date_default_timezone_set('Europe/Berlin'); //décalage horaire du serveur free
		$horodatage = date('Y-M-j_H-i-s');
		
			
		//Mise en forme du chemin de fichier
		/* $dossier= 'upload_'.date('Y-M-j'); */
		$dossier = 'upload';
		/* $fichier= 'photo-'.$nom1.'-'.$prenom1.'_'.$horodatage.'_'.$_SERVER["REMOTE_ADDR"].'_'.$_FILES['fichier']['name']; */
		$fichier= 'photo-'.$nom1.'-'.$prenom1.'_'.$horodatage.'.jpg';
		// nom du fichier sous la forme complète nom prénom nom prénom horodatage ( IP et nom initial du fichier)
			
		//Déplacement du fichier de la zone tmp vers la zone définitive
		if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier.'/'.$fichier ))
		{
			$messageReussite= 'Le fichier a bien été téléchargé.';
		}
			
}//fin formulaire valide