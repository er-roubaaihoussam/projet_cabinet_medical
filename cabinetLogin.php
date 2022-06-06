<?php
     require "utils.php";
     ouvreSession();
     if(isset($_POST['login']))
     {
         if(existe($_POST['email'])&&existe($_POST['password']))
         {
            $nmbrerreur=0;
            $bdd=base_donnees();
            $email=$_POST['email'];
            $password=$_POST['password'];
            $reqemail=$bdd->prepare('SELECT Email FROM compte WHERE Email=:email_user');
            $reqemail->bindValue('email_user',$email);
            $reqemail->execute();
            $listemail=$reqemail->fetchALL(PDO::FETCH_ASSOC);
            if(empty($listemail))
               {++$nmbrerreur;}
            else
          {
            $reqpassword=$bdd->prepare('SELECT password FROM compte WHERE Email=:mail');
            $reqpassword->bindValue('mail',$email);
            $reqpassword->execute();
            $listpassword=$reqpassword->fetchALL(PDO::FETCH_ASSOC);
        if($password!=$listpassword[0]['password'])
        {++$nmbrerreur;}
          }
    
    if($nmbrerreur==0)
    {
        $req=$bdd->prepare('SELECT * FROM compte WHERE Email=:mail AND password=:pass');
        $req->bindValue('mail',$email);$req->bindValue('pass',$password);
        $req->execute();
        $list=$req->fetchALL(PDO::FETCH_ASSOC);
        $TypeCompte=$list[0]['TypeCompte'];
        $_SESSION['typeCompte']=$TypeCompte;
        $_SESSION['idcompte']=$list[0]['IdCompte'];
        $_SESSION['email']=$email;
        $_SESSION['password']=$password;
        $_SESSION['nom']=$list[0]['NomUser'];
        $_SESSION['prenom']=$list[0]['PrenomUser'];
        $_SESSION['cin']=$list[0]['CinUser'];
        $_SESSION['adresse']=$list[0]['addressUser'];
        $_SESSION['telephone']=$list[0]['TelephoneUser'];
        $_SESSION['sexe']=$list[0]['SexeUser'];
        $_SESSION['ville']=$list[0]['Ville'];
        $_SESSION['typecompte']=$list[0]['TypeCompte'];
        $_SESSION['naissance']=$list[0]['NaissanceUser'];


        

        if($TypeCompte=='patient')
        {
            
            header('Location: accueilPatient.php');
        }
        elseif($TypeCompte=='secretaire')
        {
            header('Location: accueilSecretaire.php');
        }
        elseif($TypeCompte=='medecin')
        {
            header('Location: accueilMedecin.php');
        }
        
    }
    
    
  }
 }
?>
<!DOCTYPE html>
<html>
      <head>
	       <title>login</title>
	       <meta charset="utf-8">
		   <link rel="stylesheet" href="style-connexion.css">
       <link rel="stylesheet" href="css/bootstrap.min.css">
       <script src="https://kit.fontawesome.com/3f8b3dee73.js" crossorigin="anonymous"></script>
        </head>
    
          <body>
             <!--BEGIN BREADCRUMB-->
             <nav class="col-12">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                        <li class="breadcrumb-item active">Connexion</li>
                    </ol>
                </nav>
       <!--FIN-->
            <form method="POST" class="mx-auto px-5 conteneur">
                <i class=" pt-2 far fa-user fa-4x d-block mx-auto user"></i>

                
                <label for="email" class="form-label pt-3">email</label>
                <div class="email">
                    <input type="email" name="email" class="form-control ps-5" id="email" placeholder="entrer votre email" style="background-color: #1565C0;color :#90CAF9;" required>
                    <i class="fas fa-envelope-square"></i>
                </div>

                
                    <label for="password" class="form-label">password</label>
                <div class="password">   
                    <input type="password" name="password" class="form-control ps-5" id="password" placeholder="entrer votre password" style="background-color: #1565C0;color:#90CAF9;" required>
                    <i class="fas fa-unlock-alt"></i>
                </div>
                <div id="erreur"></div>

                <input type="submit" value="login" name="login" id="login" class="mx-auto d-block mt-4">

                <a href="forgotpass.php" class="text-decoration-none d-block mt-2">mot de passe oublié?</a>
                <a href="inscription.php" class="text-decoration-none d-block ">s'inscrire?</a>
                <?php
                 if(isset($nmbrerreur))
                 {
                 if($nmbrerreur!=0) 
                   { echo '<script src="cabinetLogin.js"></script>';}
                 }
                    ?>
                
                
            </form>
	      </body>
      
      



</html>