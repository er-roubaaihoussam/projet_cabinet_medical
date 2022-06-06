<?php session_start();
$id_docteur = $_SESSION["idcompte"];
$conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $users = $conn->query("SELECT * FROM compte WHERE IdCompte=$id_docteur;");
    $row= $users->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="titi.css">
    <link rel="stylesheet" href="toto.css">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

 

<script type="text/javascript">
function generatepdf(){


        
        var element = document.getElementById('container_content'); 

        html2pdf().from(element).save();



         
    }



</script>
</head>
<body>
<div class="text-center" style="padding:20px;,text-align:center;">
	<button onclick="generatepdf()">  Générer PDF</button>
    <button><a href="dossiersPatient.php" >retour</a></button>
</div>



<div class="container_content" id="container_content" >
		
    <h1> <u> Certificat Médical </u></h1>
    <div id="test">
    <div class="hiho">Date:<?php echo $_SESSION["date"] ?></div><br><br>
    &nbsp;Concernant : <?php echo $_SESSION["nom_patient"] ; ?><br>
    &nbsp;Date de naissance : <?php echo $_SESSION["age"] ; ?> <br>
    &nbsp;CIN : <?php echo $_SESSION["cin"] ; ?> <br><br>
    &nbsp;Je soussigné, Dr <?php echo $row['PrenomUser'].' ' . $row['NomUser']; ?> ,Ville : <?php echo $row['Ville'] ?> <br>
    &nbsp;Tél : <?php echo $row['TelephoneUser'] ?>, atteste avoir examiné la personne sus nommée est certifie. <br>
<?php
    foreach ($_SESSION["choix"] as $key=>$value){ 
            echo "&nbsp;- " . $value."<br />";
        }
        echo '<br>&nbsp;'. $_SESSION["contenu"] ;
?>
<br><br><div class="hiho">Signature: </div>
</div>

</body>
</html>