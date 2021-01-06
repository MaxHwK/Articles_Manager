<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styleCOM.css" />
	<title> Accueil </title>
</head>

<?php
	include "connexion.php";
	session_start();
	if(isset($_SESSION['adressemail']) && $_SESSION['adressemail']!='') {
		$etat_deco='visibility:visible;';
		$etat_co='visibility:hidden;';

		$message = "Vous êtes connecté en tant que : ".$_SESSION['adressemail'];
	}
	else {
		$etat_deco='visibility:hidden;';
		$etat_co='visibility:visible;';
	}
?>

<body id="index">

	<div>
		<div id="Header">
			<div id="left">
				<form id='fermer-index' name='fermer' method='post' action="LogoutPage.php">
					<input type='submit' id='soumettre-index-logout' value='Se d&eacute;connecter' class="box-button-logout" style='<?php echo $etat_deco; ?>'/>
				</form>
			</div>
			<div id="center"> <h1> Accueil </h1> </div>
				<div id="right">
					<form id='fermer-index' name='Connexion' method='post' action="LoginPage.php">
						<input type='submit' id='soumettre-index' value='Connexion' class="box-button-index" style='<?php echo $etat_co; ?>'/>
					</form>

					<form id='fermer-index' name='Inscription' method='post' action="RegisterPage.php">
						<input type='submit' id='soumettre-index' value="Inscription" class="box-button-index" style='<?php echo $etat_co; ?>' />
					</form>
			</div>
		</div>
	</div>

	<?php if (! empty($message)) { ?>
		<section class="profil">
			<p class="errorMessage"> <?php echo $message; ?> </p>
		</section>
	<?php } ?>

	<section class="box-index">

  	<form method="POST" action="index.php">
			<h1> Voici les derniers articles : </h1>
   		<label for="tri"> Trier les articles par : </label>
    	<select name="tri">

    	<?php
      	if (isset($_POST['tri'])&&$_POST['tri']==1) {
        	echo "<option value='1'> Theme <option value='0'> Date";
      	}
	      else {
        	echo "<option value='0'> Date <option value='1'> Theme";
      	}
    	?>

    	</select>
    	<input type="submit" value="Valider" class="box-button-valid">
  	</form>

		<p class='article'> </p>

  	<?php
    	if (isset($_POST['tri'])&&$_POST['tri']==1) {
      	$req1="SELECT * FROM news, theme, redacteur WHERE news.idtheme=theme.idtheme AND
					redacteur.idredacteur=news.idredacteur ORDER BY news.idtheme";
      	$result=$objPdo->query($req1);
      	foreach($result as $row) {
        	echo ("<h2 class='titre'>".$row['titrenews']."</h2>");
        	echo ("<p class='article'>".$row['textenews']."<br> <br>". "Theme : ".$row['description']."<br> <br>
          	Date : ".$row['datenews']."<br> <br>"."Auteur : ".$row['prenom']." ".$row['nom']."</p> ");
      	}
    	}
    	elseif (!isset($_POST['tri'])||$_POST['tri']==0) {
      	$req2="SELECT  * FROM news,theme,redacteur WHERE news.idtheme=theme.idtheme AND
					redacteur.idredacteur=news.idredacteur ORDER BY news.datenews DESC";
      	$result2=$objPdo->query($req2);
      	foreach($result2 as $row2) {
        	echo ("<h2 class='titre'>".$row2['titrenews']."</h2>");
        	echo ("<p class='article'>".$row2['textenews']."<br> <br>". "Theme : ".$row2['description']."<br> <br>
          	Date : ".$row2['datenews']."<br> <br>"."Auteur : ".$row2['prenom']." ".$row2['nom']."</p> ");
      	}
    	}
  	?>

  	<form id='redaction' name='redaction' method='post' action="redaction.php">
			<input type='submit' id='rediger' value="Rediger un Article" class="box-button-art" style='<?php echo $etat_deco; ?>' />
		</form>
	</section>

</body>
</html>
