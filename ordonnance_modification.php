<?php session_start();
$idcompte = $_SESSION['idcompte'];  




$conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$us = $conn->query("SELECT * FROM compte WHERE IdCompte=$idcompte;");
$lilo = $us->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="toto.css">
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
	<button onclick="generatepdf()"> Générer PDF</button>
    <button><a href="dossiersPatient.php" >retour</a></button>

</div>


<div class="container_content" id="container_content" >
<br>
    <div class="container">
        <div class="leftpane"><b>&nbsp;Dr <?php echo $lilo['PrenomUser'].' ' . $lilo['NomUser']; ?></b> <br>
        &nbsp;Médecin Gynécoloque <br>
        &nbsp;Tel : 0601020304 <br>
        &nbsp;<?php echo $lilo['Email'];?>
       </div>
        <div class="middlepane"><img src="pharmacy.png" alt="Flowers in Chania" width="160" height="100"></div>
        <div class="rightpane"><b>Clinique MonCabinet </b> <br>
                            Adresse:Km 7 Route d'El Jadida <br>  
                               Casablanca BP 8108 Maroc <br>
                               Tel : 0601020304
        </div>
    </div>
    <h1><u>Ordonnance médicale</u></h1>
        
    <div class="hiho"><h4>Date : <?php echo $_SESSION["date"] ?></h4></div>
    <div class="nom_patient"><h3> &nbsp;&nbsp;&nbsp;&nbsp;Nom du Patient: <?php echo $_SESSION["nom_patient"] ?></h3></div>
    <br><br><br>
    <?php
    foreach ($_SESSION['medicament'] as $key => $val) {
            echo '<h3><div>&nbsp; - '.$val. '</div></h3>';
        }
    ?>

    
    <div class="hiho"> <h4>Signature : </h4></div></div>
</body>
</html>