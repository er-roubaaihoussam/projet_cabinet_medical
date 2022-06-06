<?php
session_start();
$connection = @(mysqli_connect('localhost', 'root', '' , 'cabinetdb')) or die ('Echec de se connecter à la base de donnée');

if(!isset($_GET["code"])){
    exit("Can't find page");
}
$code = $_GET["code"];
$getEmailquery = mysqli_query($connection," SELECT email FROM resetpassword WHERE code ='$code'");
if(mysqli_num_rows($getEmailquery) == 0){
    exit("Can't find page");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="reset.css">
</head>
<body>
    <div class="main">
        <p class="signin">Réinitialiser votre mot de passe</p>
        <form class="form1" method="post">
          <!-- <input class="identifiant " type="text" name="username" placeholder="Identifiant" required = ""> -->
          <input class="motdepasse " type="password" name="password" placeholder="Nouveau mot de passe" required = "">
          <input class="motdepasse" type="password" name="confirmpassword" placeholder="Confirmer mot de passe" required = "">
          <input class = "soumettre" type = "submit" name = "login" value = "Réinitialiser mot de passe">
          <p class="oublie"><a href="cabinetLogin.php" >Accueil</a></p>
               
                    
    </div>
    
    <?php
        if (isset($_POST['login'])){
            if($_POST['password']== $_POST['confirmpassword']){
                $password = $_POST['password'];
                $ligne = mysqli_fetch_array($getEmailquery);
                $email = $ligne['email'];

                $query = mysqli_query($connection," UPDATE compte SET password = '$password' WHERE email = '$email'"); 
                if ($query){
                    $query = mysqli_query($connection," DELETE FROM resetpassword WHERE code = '$code' ");
                    echo'<script>
                    alert(\'Votre mot de passe est bien modifié\');
                    </script>';
                    
                }else{
                    echo'<script>
                    alert(\'Erreur\');
                    </script>';
                }
                
               
        }else{
            echo'<script>
                    alert(\'Votre mot de passe et son confirmation ne sont pas identiques\');
                </script>';
        }
        }

    ?>
</body>
</html>