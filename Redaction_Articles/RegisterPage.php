<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styleCOM.css" />
  <title> Inscription </title>
</head>

<body>

  <?php
    include "connexion.php";

    if(isset($_POST['submit'])) {

      function verif_email($adressemail) {
        $syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
        if(preg_match($syntaxe,$adressemail))
          return true;
        else
          return false;
        }

        if (!verif_email($_POST['adressemail'])) {
          /* $messagemail = "Email invalide"; */
        }

        if ($_POST['confirmdp'] != $_POST['motdepasse'] ) {
          /* $messagemdp = "Les 2 mots de passe sont différents"; */
        }
    }

    if (!empty($_POST)) {
      $ok=true;
      $nom = $_POST['nom']=trim(htmlentities($_POST['nom']));
      $prenom = $_POST['prenom']=trim(htmlentities($_POST['prenom']));
      $adressemail = $_POST['adressemail']=trim(htmlentities($_POST['adressemail']));
      $motdepasse = $_POST['motdepasse']=trim(htmlentities($_POST['motdepasse']));
      $confirmdp=$_POST['confirmdp'];
      $select = mysqli_query($conn, "SELECT * FROM redacteur WHERE adressemail = '$adressemail'") or die(mysql_error());

      if(mysqli_num_rows($select) == 0) {
        $insert_stmt = $objPdo->prepare("INSERT INTO `redacteur` (`idredacteur`, `nom`, `prenom`, `adressemail`, `motdepasse`)
          VALUES (NULL,?,?,?,?)");
        $insert_stmt->bindValue(1, $nom);
        $insert_stmt->bindValue(2, $prenom);
        $insert_stmt->bindValue(3, $adressemail);
        $insert_stmt->bindValue(4, $motdepasse);
        $insert_stmt->execute();
        $messageV = "Vous êtes maintenant membre";
      }
      else {
        $message = "Cette adresse email est déjà utilisée";
        echo $messagemail;
      }
    }
  ?>

  <form class="box" action="" method="post" name="register">
    <h1 class="box-title">Inscription</h1>
    <input id="nom" type="text" class="box-input" name="nom" placeholder="Nom" required />
    <input id="prenom" type="text" class="box-input" name="prenom" placeholder="Prenom" required />
    <input id="adressemail" type="mailformat" class="box-input" name="adressemail" placeholder="Email" required />
    <input id="motdepasse" type="password" class="box-input" name="motdepasse" placeholder="Mot de passe" required />
    <input id="confirmdp" type="password" class="box-input" name="confirmdp" placeholder="Confirmation mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />

    <p class="box-register"> Déjà inscrit? <a href="LoginPage.php"> Connectez-vous ici </a> </p>
    <p class="box-register"> <a href="index.php">Retour à la page d'accueil</a> </p>

    <?php if (!empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>

    <?php if (!empty($messagemail)) { ?>
      <p class="errorMessage"><?php echo $messagemail; ?></p>
    <?php } ?>

    <?php if (!empty($messagemdp)) { ?>
      <p class="errorMessage"><?php echo $messagemdp; ?></p>
    <?php } ?>

    <?php if (!empty($messageV)) { ?>
      <p class="VMessage"><?php echo $messageV; ?></p>
    <?php } ?>
  </form>

</body>
</html>
