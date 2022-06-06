<?php
    session_start();
    $idcompte = $_SESSION['idcompte'];  
    $idcompte_patient = $_GET['id'];
    
    
    
    
    $conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $us = $conn->query("SELECT * FROM compte WHERE IdCompte=$idcompte;");
    $lilo = $us->fetch_assoc();
    $users = $conn->query("SELECT * FROM compte WHERE IdCompte=$idcompte_patient;");
    $row= $users->fetch_assoc();
    $_SESSION["idcompte_patient"] =$row["IdCompte"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="titi.css">
    <link rel="stylesheet" href="toto.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="leftpane"><b>Dr <?php echo $lilo['PrenomUser'].' ' . $lilo['NomUser']; ?></b> <br>
                              Médecin Gynécologue <br>
                              Tel : 0601020304 <br>
                              <?php echo $lilo['Email'];?>
       </div>
        <div class="middlepane"><img src="pharmacy.png" alt="Flowers in Chania" width="160" height="100"></div>
        <div class="rightpane"><b>Clinique MonCabinet </b> <br>
                               Adresse:Km 7 Route d'El Jadida <br>  
                               Casablanca BP 8108 Maroc <br>
                               Tel : 0601020304
        </div>
    </div>
    <h1><u>Ordonnance médicale</u></h1>
    <form method="Post" action="ordonnance_save.php">
        
    <div class="dte">Date : <input type="text" id="date" name="date" value="<?php echo date("Y/m/d");?>"></div>
    <div class="nom_patient"> Nom du Patient: <input type="text" id="nom_patient" name="nom_patient" value="<?php echo $row['PrenomUser'].' ' . $row['NomUser']; ?>"></div>
    <br><br><br>
    <div class="wrap">
        <h2>Liste des médicaments:</h2>
    <div id="survey_options">
      <input type="text" name="survey_options[]" id="1" class="survey_options" size="50" placeholder="médicament">
    <br></div>
    <div class="controls">
      <a href="#" id="add_more_fields"><i class="fa fa-plus"></i>Ajouter</a>
      <a href="#" id="remove_fields"><i class="fa fa-plus"></i>Supprimer</a>
    </div>
  </div>
<script src="script.js"></script>
<div class="hiho"><input name="submit_form" type="submit" value="Enregistrer"> </div>
    </form>
    <button><a href="dossiersPatient.php" >retour</a></button>


</body>
</html>