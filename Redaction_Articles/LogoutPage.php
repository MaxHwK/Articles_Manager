<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styleCOM.css" />
  <title> Deconnexion </title>
</head>

<body>

  <?php
    session_start();
    if(!isset($_SESSION['adressemail'])) {
      $message = "Tu n'es pas connecter";
      $etat_deco='visibility:hidden;';
      $etat_co='visibility:visible;';
    }
    elseif (isset($_POST['disconnect'])) {
      session_start();
      $_SESSION[] = array();
      session_destroy();
      header("location: index.php");
    }

    if (isset($_POST['back'])) {
      header("location: index.php");
    }
  ?>

  <?php if (! empty($message)) { ?>
    <p class="warninglogout" style='<?php echo $etat_co; ?>'><?php echo $message; ?> </p>
    <p class="box-register">
	  <a href="index.php">Retour à la page d'accueil </a> </p>
  <?php } ?>

  <form  method="POST" class="box"  name="logout" style='<?php echo $etat_deco; ?>' >
    <h1 class="box-title">Deconnexion</h1>
    <p class="box-logout-text"> Voulez vous vraiment être deconnecter ? </p> <br>
    <input class="box-button" type='submit' name='disconnect' value='Deconnexion'> </input>
    <p class="box-register">
	  <a href="index.php">Retour à la page d'accueil </a> </p>
  </form>

</body>
</html>
