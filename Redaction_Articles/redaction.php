<?php
	include "connexion.php";
	session_start();

	if(!isset($_SESSION['adressemail'])) {
		header("Location: LoginPage.php");
		exit();
	}

	if (!empty($_POST)) {
		$ok=true;
		$titrenews = $_POST['titrenews']=trim(htmlentities($_POST['titrenews']));
		$idtheme = $_POST['idtheme']=trim(htmlentities($_POST['idtheme']));
		$textenews = $_POST['textenews']=trim(htmlentities($_POST['textenews']));


		if($ok) {
			$insert_stmt = $objPdo->prepare("INSERT INTO `news` (`idnews`, `idtheme`, `titrenews`, `datenews`, `textenews`, `idredacteur`)
				VALUES (NULL, ? , ?, NOW(), ?,'1')");
			$insert_stmt->bindValue(1, $idtheme);
			$insert_stmt->bindValue(2, $titrenews);
			$insert_stmt->bindValue(3, $textenews);
			$insert_stmt->execute();
		}
	}
?>

<html>

<head>
	<meta charset="utf-8">
  <link rel="stylesheet" href="styleCOM.css" />
  <title> Redaction d'un Article </title>
</head>

<body>

	<form class="box" action="" method="post" name="register">
		<h1 class="box-title"> Redaction d'un article </h1>
		<input id="titrenews" type="text" class="box-input" name="titrenews" placeholder="Titre de l' article" required />

		<label for="idtheme"> Theme : </label>
		<select id="idtheme" name="idtheme">
  		<option value="1">Sport</option>
  		<option value="2">Musique</option>
 			<option value="3">Cinema</option>
		</select> <br> <br> <br>

		<textarea id="textenews" name="textenews" cols="50" rows="5" placeholder ="Veuillez rediger l' article ici ... "
			class="box-text-area" required> </textarea> <br> <br>
		<input type="submit" value="Enregistrer" name="save" class="box-button"/> <br/> <br/>

		<p class="box-register">
			<a href="index.php"> Retour à la page d'accueil </a> </p>
	</form>

</body>
</html>
