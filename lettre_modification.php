<?php session_start();
  $idcompte = $_SESSION["idcompte"];  
  
  
  
  
  $conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $users = $conn->query("SELECT * FROM compte WHERE IdCompte=$idcompte;");
    $row= $users->fetch_assoc();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

 

<script type="text/javascript">
function generatepdf(){
        
        var element = document.getElementById('container_content'); 
        html2pdf().from(element).save();

         
    }



</script>
</head>
<body>
<div class="text-center" style="padding:20px;text-align:center;">
	<button onclick="generatepdf()">  Générer PDF</button>
  <button><a href="dossiersPatient.php" >retour</a></button>
</div>



<div class="container_content" id="container_content" >
        <div><br><b>&nbsp;Cabinet MonCabinet </b> <br>
        &nbsp;Adresse:Km 7 Route d'El Jadida <br>  
        &nbsp;Casablanca BP 8108 Maroc <br>
        <!-- &nbsp;ici <br> -->
        &nbsp;Tel : 0601020304 <br><br>
        &nbsp;<b>Dr<?php echo $row['PrenomUser'].' ' . $row['NomUser']; ?> </b> <br>
        &nbsp;Médecin Gynécologue <br><br>
        </div>   
        <div class="hiho">
            <b>Dr <?php echo $_SESSION["dr_destinataire"] ?></b> <br>
            Médecin <?php echo $_SESSION["specialite"] ?> <br><br>
            Adresse:<?php echo $_SESSION["adresse"] ?> <br>
            <br><br><br>
            Date:<?php echo $_SESSION["date"] ?>
        </div>
        <pre>     objet:<?php echo $_SESSION["objet"] ?></pre> <br>
        <pre><?php echo $_SESSION["contenu"] ?></pre>
    
    <!-- <h1><u>Ordonnance médicale</u></h1>
    <form method="Post" action="fiche-save.php">
        
    <div class="dte">Date : <input type="text" id="date" name="date" value=""></div>
    <div class="nom_patient"> Nom du Patient: <input type="text" id="nom_patient" name="nom_patient" value=""></div>
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
<input name="submit_form" type="submit" value="Enregistrer">
    </form> -->
        
    <br><br><div class="hiho"> Signature : </div> </div>

</body>
</html>