<?php

require "utils.php";



session_start();
$idcompte = $_SESSION['idcompte'];  
$idcompte_patient = $_GET['id'];




$conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$users = $conn->query("SELECT * FROM compte WHERE IdCompte=$idcompte_patient;");
$row= $users->fetch_assoc();
$_SESSION["idcompte_patient"] =$row["IdCompte"];
$_SESSION["sexe"] =$row["SexeUser"];
if($_SESSION['typecompte']=='secretaire')
        {
            $_SESSION['page']="accueilSecretaire.php";
        }
elseif($_SESSION['typecompte']=='medecin')
        {
            $_SESSION['page']="accueilMedecin.php";
        }

//pour listes de rendez-vous  

$sql2 = "SELECT rdv.idRdv , rdv.DateRdv , rdv.prix ,
  compte.PrenomUser , compte.NomUser , compte.TelephoneUser , compte.Email
   FROM `rdv` join compte 
   WHERE compte.IdCompte = rdv.idCompte AND compte.IdCompte = '$idcompte' ; " ;

?>

  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-fiche.css">
    
    <title>Document</title>
</head>
<body>
    <h1>Patient: <?php echo $row["PrenomUser"].' '.$row["NomUser"]?> </h1>
    <a href="tcpdf1.php" ><h2>generer PDF</h2></a>
    <a href="fiche-modification.php" ><h2>modifier</h2></a>
    <a href="<?= $_SESSION['page'] ?>"><h2>retour</h2></a>
        <div class="flex-container">
            <div class="flex-child">
        <fieldset>
            <legend><h3>Informations Patients</h3></legend>
        <p><label for="lastname"> Nom:</label> <b><?php echo $row["NomUser"]?></b>  
            <tab1><label for="firstname"> Prénom:</label> <b><?php echo $row["PrenomUser"]?></b></tab1>
        </p>

        <p><label for="cin"> CIN:</label> <b><?php echo $row["CinUser"]?></b>
            <tab1></tab1><label for="gender"> Sexe:</label> <b><?php echo $row["SexeUser"]?></b>
        </p>
        <p>
            <label for="birthday"> Date de naissance:</label> <b><?php echo $row["NaissanceUser"]?></b>
            <!-- <tab1> <label for="birthlocation"> Lieu de naissance:</label> <b><?php echo ""?></b></tab1> -->
        </p>
        </fieldset>
            </div>
        <div class="flex-child">
        <fieldset>
            <legend><h3>Adresse et Contact</h3></legend>
            <label for="address"> Adresse:</label> <b><?php echo $row["addressUser"]?></b>
            <p><label for="city"> Ville:</label> <b><?php echo $row["Ville"]?></b>
            <label for="email"> email:</label> <b><?php echo $row["Email"]?></b><br><br>
            <label for="telephone_portable"> Téléphone Portable:</label> <b><?php echo $row["TelephoneUser"]?></b>

        </p>
        
    
        </fieldset>
    </div>
</div>
    

</body>

</html>