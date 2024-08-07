<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<title>PSI* lyc&eacute;e la Martini&egrave;re Monplaisir, Lyon</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="fr" />

<link rel="shortcut icon" href="/favicon.png" type="image/png" />

<link rel="stylesheet" href="https://ghaberer.bitbucket.io/general/default.css" type="text/css" />

<script type="text/javascript" src="https://ghaberer.bitbucket.io/general/entete.js"></script>
<script type="text/javascript" src="https://ghaberer.bitbucket.io/general/pieddepage.js"></script>


</head>

<body id="pagematiere">

<div id="header">
  <script type="text/javascript"> entete(); </script>
</div> <!-- header -->

<div id="content">
  
<div id="maintext">
  
  <h1>Envoi de votre photo</h1>
  
  <?php  
  if (isset($_POST['fichier_envoye']))
  {
  include('traitement_envoi_photo.php');
  }
  ?>
  

	  
  <p>
  <!-- le formulaire d'envoi -->
  <form method="post" action="index_photo.php" enctype="multipart/form-data">

  <h2>Sélection du fichier &agrave; envoyer</h2>

  <p>
  <fieldset>
  <input type="file" name="fichier"/>
  <?php 
  if (isset($messageErreurFichier))
  {
  echo '<p class="erreur">'.$messageErreurFichier.'</p>';
  }
  ?>
  </fieldset>
  <i>Merci de privil&eacute;gier le format JPEG.</i></p>

  <!-- <h2>Pour qui ?</h2> -->
  <!-- <SELECT name="pourQui">  -->
  <!--  <OPTION value="gh" selected>Guillaume Haberer</OPTION>  -->
  <!--  <\!-- <OPTION value="xp">Xavier Pessoles</OPTION> -\-> -->
  <!--  <\!-- <OPTION value="jyr">Jean-Yves Raulin</OPTION> -\-> -->
  <!--  <\!-- <OPTION value="madl">Marie-Aude de Langenhagen</OPTION> -\-> -->
  <!--  <\!-- <OPTION value="ls">Lee Smart</OPTION> -\-> -->
  <!-- </SELECT> -->
  
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
  <br />				
  <label for="Prenom">Prénom : </label><input type="text" name="Prenom1" id="Prenom1"/>
  <br />				
  <!-- <label for="Quoi"> Quoi : </label><input type="text" name="Quoi1" id="Quoi1"/> -->
  <!-- <br /> -->
  <!-- <label for="Message1"> Message &eacute;ventuel pour le prof : </label><input type="text" name="Message1" id="Message1"/> -->
  <!-- <br /> -->
  </fieldset>				  
  
  
  <br>
  <i>Soyez patient</i>
  <br>
  <input type="submit" value="Envoyer le fichier"
  name="fichier_envoye"/>
  <br>
  <i>et ne fermez pas la fen&ecirc;tre avant le message vert
  indiquant que le t&eacute;l&eacute;chargement a bien eu lieu.</i>
  <br>
  <i>En fonction de la qualit&eacute; de votre connexion, cela peut
  prendre plusieurs minutes.</i>
  </form>
  
  
  </p>
  
</div> <!-- maintext-->

<div id="sidepanel">

  
  <?php //affiche un message en cas de réussite
  if (isset($messageReussite))
  {
  echo '<p class="reussite">'.$messageReussite.'</p>';
  $to      = 'ghaberer+envoifichier@lamartin.fr';
  $subject = 'envoi fichier';
  $message = $message1."\r\n \r\n".'Envoi de http://einexau.cluster028.hosting.ovh.net/envoi/upload/gh/'.$fichier;
  $headers = 'From: ghaberer+envoifichier@lamartin.fr' . "\r\n" .
  'Reply-To: ghaberer+envoifichier@lamartin.fr' . "\r\n" .
  'X-Mailer: PHP/'.phpversion();
  mail($to, $subject, $message, $headers);
  }
  ?>

  <?php //affiche un message en cas d'erreur 
  if (isset($messageErreurNom) OR isset($messageErreurFichier))
  {
  echo '<p class="erreur">Une erreur s\'est produite.</p><p
  class="erreur">
  Aucun transfert de fichier n\'a eu lieu</p>';
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
