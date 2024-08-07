<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<title>PSI* lyc&eacute;e la Martini&egrave;re Monplaisir, Lyon</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="fr" />

<link rel="shortcut icon" href="/favicon.png" type="image/png" />

<link rel="stylesheet" href="http://ghaberer.bitbucket.org/general/default.css" type="text/css" />

<script type="text/javascript" src="http://ghaberer.bitbucket.org/general/entete.js"></script>
<script type="text/javascript" src="http://ghaberer.bitbucket.org/general/pieddepage.js"></script>


</head>

<body id="pagematiere">

  <div id="header">
    <script type="text/javascript"> entete(); </script>
  </div> <!-- header -->

  <div id="content">

	<div id="maintext">

	  <h1>Envoi d'un fichier</h1>

	  <?php
	  $liste_classes = array('PSI*') ;
	  
	  if (isset($_POST['fichier_envoye']))
	  {
	  include('traitement_envoi_fichier.php');
	  }
	  ?>
	  

	  <p>Sélectionnez votre fichier, précisez vos noms et prénoms, puis
	  cliquez sur le bouton d'envoi.</p>
	  
	  <p>	<!-- le formulaire d'envoi proprement dit -->
	  <form method="post" action="envoi_fichier.php" enctype="multipart/form-data">
	  <h2>Sélection du fichier &agrave; envoyer</h2>
	  <fieldset>
	  <input type="file" name="fichier"/>
	  <?php 
	  if (isset($messageErreurFichier))
	  {
	  echo '<p class="erreur">'.$messageErreurFichier.'</p>';
	  }
	  ?>
	  <!-- </fieldset> -->
	  <!-- <h2>Premier &eacute;tudiant</h2> -->
	  <!-- <fieldset> -->

	  </fieldset>
	  <h2>Identit&eacute;</h2>
	  <fieldset>
			
	  <label for="Nom1">Nom : </label><input type="text" name="Nom1" id="Nom1"/>
	  <!-- Affichage du message d'erreur éventuel : -->
	  <?php 
	  if (isset($messageErreurNom))
	  {
	  echo '<p class="erreur">'.$messageErreurNom.'</p>';
	  }
	  ?>
	  <!--  -->
	  <br />
				
	  <label for="Prenom">Prénom : </label><input type="text" name="Prenom1" id="Prenom1"/>
	  </fieldset>
			
	  <!-- <h2>Deuxième &eacute;tudiant (en cas de binôme)</h2> -->
	  <!-- <fieldset> -->
			
	  <!-- <label for="Nom2">Nom : </label><input type="text" name="Nom2" id="Nom2"/> -->
	  <!-- <br /> -->
	  
	  <!-- <label for="Prenom">Prénom : </label><input type="text" name="Prenom2" id="Prenom2"/> -->
	  <!-- </fieldset> -->
	  
	  
	  <br>
	  <input type="submit" value="Envoyer le fichier" name="fichier_envoye"/>
	  </form>

  
	  </p>

	</div> <!-- maintext-->

	<div id="sidepanel">
	    
	  <?php //affiche un message en cas de réussite
	  if (isset($messageReussite))
	  {
	  echo '<p class="reussite">'.$messageReussite.'</p>';
	  $to      = 'ghaberer+ipt@lamartin.fr';
	  $subject = 'envoi fichier';
	  $message = 'Envoi de http://psietoile.lamartin.free.fr/envoi/upload/'.$fichier;
	  $headers = 'From: ghaberer+ipt@lamartin.fr' . "\r\n" .
	  'Reply-To: ghaberer+ipt@lamartin.fr' . "\r\n" .
	  'X-Mailer: PHP/' . phpversion();
	  
	  mail($to, $subject, $message, $headers);
	  }
	  
	  ?>
	  <?php //affiche un message en cas d'erreur 
	  if (isset($messageErreurNom) OR isset($messageErreurClasse) OR isset($messageErreurFichier))
	  {
	  echo '<p class="erreur">Une erreur s\'est produite.</p><p class="erreur"> Aucun transfert de fichier n\'a eu lieu</p>';
	  }
	  ?>
	  
	  
	</div> <!-- sidepanel-->

		<div id="footer">
		  <p id="psietoile-details">
		  <script type="text/javascript">
		  var nom1 = "ghaberer";
		  var domaine = "lamartin.fr";
		  contact1();
		  </script>
		  </p>
		
		</div> <!-- footer -->
</div> <!-- content -->

</body>

</html>