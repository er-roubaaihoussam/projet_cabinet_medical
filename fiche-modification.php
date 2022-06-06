<?php
require "utils.php";

session_start();

$idcompte_patient = $_SESSION["idcompte_patient"];

$conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$users = $conn->query("SELECT * FROM compte WHERE IdCompte='$idcompte_patient'");
$row= $users->fetch_assoc();


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
    <a href="fiche.php?id='<?php echo $row['IdCompte'] ?>'" ><h2>retour</h2></a>
    <form method="post" action="fiche-save.php">
        <div class="flex-container">
            <div class="flex-child">
        <fieldset>
            <legend><h3>Informations Patients</h3></legend>
        <p><label for="lastname"> Nom:</label>   <input id="lastname" name="f_lastname" type="text" value="<?php echo $row['NomUser']; ?>" required> 
            <tab1><label for="firstname"> Prénom:</label> <input id="firstname" name="f_firstname" type="text" value="<?php echo $row['PrenomUser']; ?>" required></tab1>
        </p>

        <p><label for="cin"> CIN:</label> <input id="cin" name="f_cin" type="text" value="<?php echo $row['CinUser']; ?>" required>
            <tab1></tab1><label for="gender"> Sexe:</label> <input id="gender" name="f_gender_homme" type="radio" value="H" >Homme
            <input id="gender" name="f_gender_femme" type="radio" value="F" >Femme </tab1>
        </p>
        <p>
            <label for="birthday"> Date de naissance:</label> <input id="birthday" name="f_birthday" type="date" value = "<?php echo $row["NaissanceUser"]?>"required>
            <!-- <tab1> <label for="birthlocation"> Lieu de naissance:</label> <input id="birthlocation" name="f_birhlocation" type="text" value=""></tab1> -->
        </p>
        </fieldset>
            </div>
        <div class="flex-child">
        <fieldset>
            <legend><h3>Adresse et Contact</h3></legend>
        <p><label for="address"> Adresse:</label> <input id="address" name="f_address" type="text" value="<?php echo $row["addressUser"]?>" required><br><br>
            <!-- <tab1><label for="zipcode"> Code postal:</label> <input id="zipcode" name="f_zipcode" type="text" value="" ></tab1><br><br> -->
            <label for="city"> Ville:</label> <input id="city" name="f_city" type="text" value="<?php echo $row["Ville"]?>" required>
            <!-- <tab1><label for="country"> Pays:</label> <input id="country" name="f_country" type="text" value="" ></tab1><br><br> -->
            <label for="email"> email:</label> <input id="email" name="f_email" type="text" value="<?php echo $row["Email"]?>" required><br><br>
            <!-- <label for="telephone_fixe"> Téléphone Fixe:</label> <input id="telephone_fixe" name="f_telephone_fixe" type="text" value="" > -->
            <tab1><label for="telephone_portable"> Téléphone Portable:</label> <input id="telephone_portable" name="f_telephone_portable" type="text" value="<?php echo $row["TelephoneUser"]?>" required></tab1>
            <div style="display: none;">
            <label for="id">id</label>
            <input id="id" name="id" type="number" value="<?php echo $row["IdCompte"]?>">
          </div>
        </p>
        
    
        </fieldset>
    </div>
</div>
        <p>
            <input name="submit_form" type="submit" value="Enregistrer">
            <input name="reset_form" type="reset" value="Réinitialiser">
        </p> 
    </form>
</body>
</html>
