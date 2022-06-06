<?php

$servername='localhost';
$username='root';
$password='';
$dbname = "cabinetdb";
$connection = @(mysqli_connect($servername,$username,$password,"$dbname")) or die ('Echec de se connecter à la base de donnée');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="forgotpass.css">
</head>
<body>
    <div class="forgotpass">
        <p class="password">Mot de passe oublié?</p>
        <p class="declaration">Entrez votre adresse email .</p>
        <form class="form1" method="post">
          <input class="email " type="email" name="email" placeholder="Adresse Email" required = "">
          <input class = "soumettre" type = "submit" name = "reset" value = "Réinitialiser Mot de Passe">
          <p class="annule"><a href="cabinetLogin.php" >Annulé</a></p>        
                    
    </div>
    
    <?php
        if (isset($_POST['reset'])){
            $email = $_POST['email'];
            
            $code = uniqid(true);

            $select = mysqli_query($connection," SELECT * FROM compte WHERE email = '$email' ");
            $ligne  = mysqli_fetch_array($select);

            if(is_array($ligne)) {
                require_once ('mailer/mail.php');
                $mail->setFrom('ha.abdelkhalek.chmi@gmail.com', 'Abdelkhalek Hachmi');
                $mail->addAddress($email);  
                $mail->Subject = 'Reinitialiser Mot de Passe';
                $lien=  "localhost/cabinet/projet_cabinet/reset.php?code=$code";
                $mail->Body    = '<h1>Bonjour ' . $ligne["NomUser"] . '<br>' . "Pour réinitialiser votre mot de passe, <a href='$lien'>cliquez ici</a> .<h1>";
                $mail->send();

                //mail($email,$sujet,$objet);
                if(!$mail->send()) {
                    // echo 'Message could not be sent.';
                echo'<script>
                alert(\'Erreur\');
                </script>';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    // echo 'Message has been sent';
                    
                    $query = mysqli_query($connection," INSERT INTO resetpassword(code,email) VALUES ('$code','$email') ");
                    if(!$query){
                        exit("error");
                    }
             echo'<script>
                alert(\'le lien de réinitialisation du mot de passe a été envoyé à votre adresse e-mail\');
                </script>';
                }
                
            }else {
                echo'<script>
                alert(\'Votre adresse email est invalide!\');
                </script>';
                

            }
            
        }
    ?>
</body>
</html>