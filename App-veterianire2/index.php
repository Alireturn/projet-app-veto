<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";



$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
if(isset($_POST['envoi'])){
    if(!empty($_POST{'email'}) AND !empty($_POST{'passwordd'})){
       $email = ($_POST['email']);
       $mdp = ($_POST['passwordd']);

       $recupUser = $conn->prepare('SELECT * FROM profil WHERE mail = ? AND mdp = ?');
       $recupUser->execute(array($email, $mdp));
       
       if($recupUser->rowCount() > 0){
          $_SESSION['mail'] = $email;
          $_SESSION['mdp'] = $mdp;
          $_SESSION['id'] = $recupUser->fetch()['id'];
          header('location: session.php');
       }else{
        echo "votre mot de passe ou pseudo est incorrect";
       }


    }else{
       echo "Veuillez remplire completement tous les champs";
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
    <div class="wrapper-fadeInDown">
      <div id="From-content">
        <div class="txt-princ" >
          <a href="">
            <button class="button-1" >Se connecter</button>
          </a>
            <a href="./register.php">
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
          <input type="text" class="fadeIn-second" name="email" placeholder="email" />
          <input type="password" class="fadeIn-third" name="passwordd" placeholder="Mot de passe" />
          <button name="envoi" class="fadeIn-end">Connexion</button>
        </form>
        </div>
      </div>
    </div>
  </header>
</body>
</html>