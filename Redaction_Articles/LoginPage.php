<html>

<head>
  <meta charset="utf-8">
	<link rel="stylesheet" href="styleCOM.css" />
	<title> Connexion </title>
</head>

<body>

  <?php
    include "connexion.php";
    session_start();

    if (isset($_POST['adressemail'])) {
      $adressemail = stripslashes($_REQUEST['adressemail']);
      $adressemail = mysqli_real_escape_string($conn, $adressemail);
      $_SESSION['adressemail'] = $adressemail;
      $motdepasse = stripslashes($_REQUEST['motdepasse']);
      $motdepasse = mysqli_real_escape_string($conn, $motdepasse);
      $query = "SELECT * FROM `redacteur` WHERE adressemail='$adressemail'
        AND motdepasse='$motdepasse'";
      $result = mysqli_query($conn,$query) or die(mysql_error());

      if (mysqli_num_rows($result) == 1) {
          header('location: index.php');
      }
      else {
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        session_destroy();
        session_start();
      }
    }
  ?>

  <form class="box" action="" method="post" name="login">
    <h1 class="box-title">Connexion</h1>
    <input id="adressemail" type="mailformat" class="box-input" name="adressemail" placeholder="Email">
    <input id="motdepasse" type="password" class="box-input" name="motdepasse" placeholder="Mot de passe">
    <input type="submit" value="Connexion " name="submit" class="box-button">

    <p class="box-register"> Vous êtes nouveau ici? <a href="RegisterPage.php"> S'inscrire </a> </p>
    <p class="box-register"> <a href="index.php"> Retour à la page d'accueil </a> </p>

    <?php if (! empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
  </form>

</body>
</html>
