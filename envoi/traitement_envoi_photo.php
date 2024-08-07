<?php

$formulaire_valide = True; // par défaut les données sont valides

/* echo "<pre>"; */
/* print_r($_POST); */
/* echo "</pre>"; */

function traitement($nom) // uniformisation de la chaîne de caractères $nom
{
	$nom = strip_tags($nom); //suppression des balises html ou php
	$nom = str_replace(array(' ', '\'', ',', '?', ';', '.', '/', '\\', '!', ':', '-', '_'),'',$nom);
	$nom = trim($nom); // supprime les caractères invisibles en début et fin de chaîne
	// On enlève les accents :
	$nom = str_replace(
		  array(
				'à', 'â', 'ä', 'á', 'ã', 'å',
				'î', 'ï', 'ì', 'í', 
				'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
				'ù', 'û', 'ü', 'ú', 
				'é', 'è', 'ê', 'ë', 
				'ç', 'ÿ', 'ñ', 
				'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
				'Î', 'Ï', 'Ì', 'Í', 
				'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø', 
				'Ù', 'Û', 'Ü', 'Ú', 
				'É', 'È', 'Ê', 'Ë', 
				'Ç', 'Ÿ', 'Ñ', 
		  ),
		  array(
				'a', 'a', 'a', 'a', 'a', 'a', 
				'i', 'i', 'i', 'i', 
				'o', 'o', 'o', 'o', 'o', 'o', 
				'u', 'u', 'u', 'u', 
				'e', 'e', 'e', 'e', 
				'c', 'y', 'n', 
				'A', 'A', 'A', 'A', 'A', 'A', 
				'I', 'I', 'I', 'I', 
				'O', 'O', 'O', 'O', 'O', 'O', 
				'U', 'U', 'U', 'U', 
				'E', 'E', 'E', 'E', 
				'C', 'Y', 'N', 
		  ),
		  $nom);
	$nom = strtolower($nom); //met en minuscule
	return $nom;
}

//Vérification du fichier (envoi, taille, extension)	
if ($_FILES['fichier']['error']==4)
	{
		$messageErreurFichier='Aucun fichier n\'a été sélectionné...';	
		$formulaire_valide = False;
	}
elseif (!isset($_FILES['fichier']) OR $_FILES['fichier']['error']!=0)
	{
		$messageErreurFichier='Un problème technique a eu lieu lors du tranfert. Merci de réessayer.';
		$formulaire_valide = False;
	}

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

if ($formulaire_valide)
{
		//Détermination des coordonnées temporelles
		date_default_timezone_set('Europe/Berlin'); //décalage horaire du serveur free
		/* $horodatage = date('Y-M-j_H-i-s'); */
		$horodatage = date('Ymd_His');

		//extension du fichier//
		$extension = pathinfo($_FILES['fichier']['name'],PATHINFO_EXTENSION);
			
		//Mise en forme du chemin de fichier
		/* $dossier= 'upload_'.date('Y-M-j'); */
		$dossier = 'upload/photos';
		/* $fichier= $horodatage.'_'.$nom1.'-'.$prenom1.'_'.$nom2.'-'.$prenom2.'_'.$REMOTE_ADDR.'_'.$_FILES['userfile']['name']; */
		/* $fichier= $horodatage.'_'.$nom1.'-'.$prenom1.'_'.$nom2.'-'.$prenom2.'_'.$_SERVER["REMOTE_ADDR"].'_'.$_FILES['fichier']['name'];*/
		// nom du fichier sous la forme complète nom prénom nom prénom horodatage IP et nom initial du fichier
		/* $fichier= $nomTP.'_'.$horodatage.'_'.$nom1.'-'.$prenom1.'_'.$_SERVER["REMOTE_ADDR"].'.py'; */
		$fichier= $horodatage.'_'.$nom1.'-'.$prenom1.'_'.$_SERVER["REMOTE_ADDR"].'.'.$extension;
			
		//Déplacement du fichier de la zone tmp vers la zone définitive
		if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier.'/'.$fichier ))
		{
			$messageReussite= 'Le fichier a bien été téléchargé.';
		}
			
}//fin formulaire valide