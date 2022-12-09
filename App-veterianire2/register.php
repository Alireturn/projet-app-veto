<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";


if(isset($_POST['envoyer'])) {
  if(!empty(($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['password']))){
    
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO `profil` (`nom`, `prenom`, `mail`, `mdp`) VALUES (:nom, :prenom, :mail, :mdp);";

      $query = $conn->prepare($sql);

       $query->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
       $query->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
       $query->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
       $query->bindValue(':mdp', password_hash($_POST['password'] ,PASSWORD_DEFAULT), PDO::PARAM_STR);

        $query->execute();

     }catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    
      $conn = null;

    }

}else{

  echo 'Veuillez remplire tout les champs';

}


 }
?>
  

  





<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <nav class="nav-bar">
    <a href="./welcom.php">
        <img src="./assets/img/chien.png" id="chien" alt="" />
    </a>
    <h1>Dogsanté</h1>
  </nav>
  <header>  
    <div class="wrapper-fadeInDown2">
      <div id="From-content">
        <div class="txt-princ" >
          <a href="./index.php">
            <button class="button-1" >Se connecter</button>
          </a>
            <a href="./index.html">
              <button class="button-1">S'inscrire</button>
            </a>
          </div>
        </div>
        <div class="fadeIn-first">
          <img src="./assets/img/avatar-homme.png" height="80px" id="icon" alt="User Icon" />
        </div>
        <div class="login-form">
        <!-- Login Form -->
       <form action="" method="post">
        <input type="text" class="buttonregi" name="nom" placeholder="Nom">
        <input type="text" class="buttonregi" name="prenom" placeholder="Prenom">
        <input type="email" class="buttonregi" name="mail" placeholder="e-mail">
        <input type="password" class="buttonregi" name="password"placeholder="mot de passe">
        <button class="buttonfin" name="envoyer">Valider</button>
       </form> 
    
        </div>
      </div>
    </div>
  </header>
</body>
